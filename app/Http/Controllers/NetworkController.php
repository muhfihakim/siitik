<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Network;
use App\Models\Aset;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class NetworkController extends Controller
{
    public function index()
    {
        $network = Network::all();
        return view('admin.network.list_network', compact(['network']));
    }

    public function addnetwork()
    {
        $options = Aset::distinct('sn')->pluck('sn');
        return view('admin.network.add_network', compact('options'));
    }

    public function addingnetwork(Request $request)
    {
        // Validasi data yang diinput oleh pengguna sesuai kebutuhan Anda

        $network = new Network();
        $network->lokasi        = $request->lokasi;
        $network->jenis         = $request->jenis;
        $network->sn_aset       = $request->sn_aset;
        $network->titik         = $request->titik;
        $network->latitude      = $request->latitude;
        $network->longitude     = $request->longitude;
        $network->tgl_pasang    = $request->tgl_pasang;
        $network->description   = $request->description;

        // Mendapatkan tanggal, bulan, dan tahun dari tgl_pasang
        $tglPasang = date('d_m_Y', strtotime($request->tgl_pasang));

        // Menyimpan berkas BA
        if ($request->hasFile('ba')) {
            $ba = $request->file('ba');
            $baName = $tglPasang . '_' . $ba->getClientOriginalName();
            $ba->storeAs('public/file_upload/network/ba', $baName);
            $network->ba = 'file_upload/network/ba/' . $baName;
        }

        // Menyimpan berkas foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoName = $tglPasang . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/file_upload/network/foto', $fotoName);
            $network->foto = 'file_upload/network/foto/' . $fotoName;

            // Perbarui kolom 'letak' di tabel 'Aset'
            Aset::where('sn', $request->sn_aset)
                ->update([
                    'letak' => $request->titik,
                    'gambar' => 'file_upload/network/foto/' . $fotoName,
                ]);
        }

        $network->save();

        session()->flash('message', 'Jaringan Berhasil Ditambahkan');
        return redirect('/admin/network/');
    }

    public function editnetwork($id)
    {
        $network = Network::findOrFail($id);
        $jenisOptions = ['Backbone', 'ONT', 'Router', 'LAN', 'Access Point']; // Ganti dengan data dari database
        $snAsetOptions = DB::table('aset')->pluck('sn');
        return view('admin.network.edit_network', compact('network', 'jenisOptions', 'snAsetOptions'));
    }

    public function updatenetwork(Request $request, $id)
    {
        // Validasi data yang diinput oleh pengguna sesuai kebutuhan Anda

        $network = Network::findOrFail($id);

        // Mendapatkan tanggal, bulan, dan tahun dari tgl_pasang
        $tglPasang = date('d_m_Y', strtotime($request->tgl_pasang));

        // Menghapus file lama dan menyimpan file baru jika ada untuk berkas BA
        if ($request->hasFile('ba')) {
            if ($network->ba) {
                $namaAsliBA = basename($network->ba);
                Storage::disk('public')->delete('file_upload/network/ba/' . $namaAsliBA);
            }

            $ba = $request->file('ba');
            $baName = $tglPasang . '_' . $ba->getClientOriginalName();
            $ba->storeAs('public/file_upload/network/ba', $baName);
            $network->ba = 'file_upload/network/ba/' . $baName;
        }

        // Menghapus file lama dan menyimpan file baru jika ada untuk berkas foto
        if ($request->hasFile('foto')) {
            if ($network->foto) {
                $namaAsliFoto = basename($network->foto);
                Storage::disk('public')->delete('file_upload/network/foto/' . $namaAsliFoto);
            }

            $foto = $request->file('foto');
            $fotoName = $tglPasang . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/file_upload/network/foto', $fotoName);
            $network->foto = 'file_upload/network/foto/' . $fotoName;
        }

        // Update data jaringan
        $network->lokasi        = $request->lokasi;
        $network->jenis         = $request->jenis;
        $network->sn_aset       = $request->sn_aset;
        $network->titik         = $request->titik;
        $network->latitude      = $request->latitude;
        $network->longitude     = $request->longitude;
        $network->tgl_pasang    = $request->tgl_pasang;
        $network->description   = $request->description;

        // Perbarui kolom 'letak' di tabel 'Aset'
        Aset::where('sn', $request->sn_aset)
            ->update([
                'letak' => $request->titik,
                'gambar' => 'file_upload/network/foto/' . $fotoName,
            ]);

        $network->save();

        session()->flash('message', 'Data Jaringan Berhasil Diupdate');
        return redirect('/admin/network/');
    }

    public function destroy($id)
    {
        $delnetwork = Network::find($id);

        // Menghapus file fisik terkait jika ada
        if ($delnetwork->ba) {
            Storage::disk('public')->delete($delnetwork->ba);
        }
        if ($delnetwork->foto) {
            Storage::disk('public')->delete($delnetwork->foto);
        }

        $delnetwork->delete();

        session()->flash('message', 'Data Jaringan Berhasil Dihapus');
        return redirect('/admin/network/');
    }

    public function formInstalasi()
    {
        return view('admin.network.form_instalasi');
    }

    public function generateForm(Request $request)
    {
        $data = [
            'nomor_formulir'         => $request->input('nomor_formulir'),
            'nama_instansi'          => $request->input('nama_instansi'),
            'lokasi'                 => $request->input('lokasi'),
            'jenis_kegiatan'         => $request->input('jenis_kegiatan'),
            'tanggal_pelaksanaan'    => $request->input('tanggal_pelaksanaan'),
            'penjelasan_detail'      => $request->input('penjelasan_detail'),
            'tim_pelaksana'          => $request->input('tim_pelaksana'),
            'jabatan_tim_pelaksana'  => $request->input('jabatan_tim_pelaksana'),
            'pihak_opd'              => $request->input('pihak_opd'),
            'jabatan_pihak_opd'      => $request->input('jabatan_pihak_opd'),
        ];

        // Loop untuk nama barang, spesifikasi, dan keterangan
        for ($i = 1; $i <= 9; $i++) {
            $namaBarangKey = "nama_barang{$i}";
            $spesifikasiKey = "spesifikasi{$i}";
            $keteranganKey = "keterangan{$i}";

            // Periksa apakah input untuk nomor tersebut ada
            if ($request->has($namaBarangKey)) {
                $data[$namaBarangKey] = $request->input($namaBarangKey);
                $data[$spesifikasiKey] = $request->input($spesifikasiKey);
                $data[$keteranganKey] = $request->input($keteranganKey);
            }
        }

        return view('admin.network.format_instalasi', $data);
    }


    //  public function getTotalNetwork()
    //   {
    //    $totalNetwork = Network::count(); // Mengambil jumlah total VM dari tabel

    //    return view('/admin/index', ['totalNetwork' => $totalNetwork]);
    // }
}
