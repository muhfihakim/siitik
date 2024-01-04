<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aset;
use Illuminate\Support\Facades\Storage;

class AsetController extends Controller
{
    public function index()
    {
        $aset = Aset::all();
        return view('admin.aset.list_aset', compact(['aset']));
    }

    public function addaset()
    {
        return view('admin.aset.add_aset');
    }

    public function addingaset(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'nama' => 'required',
            // ... tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Mengambil data dari form
        $data = $request->all();

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarPath = 'file_upload/aset/';
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $gambar->storeAs($gambarPath, $gambarName, 'public');
            $data['gambar'] = $gambarPath . $gambarName;
        }

        // Menyimpan data aset ke database
        Aset::create($data);

        session()->flash('message', 'Aset Berhasil Ditambahkan');
        return redirect('/admin/aset');
    }

    public function editaset($id)
    {
        $aset = Aset::findOrFail($id);
        $kondisiOptions = ['Normal', 'Rusak']; // Ganti dengan data dari database
        return view('admin.aset.edit_aset', compact('aset', 'kondisiOptions'));
    }

    public function updateaset(Request $request, $id)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'nama' => 'required',
            'type' => 'required',
            'kondisi' => 'required', // Tambahkan validasi lainnya
        ]);

        // Ambil data aset berdasarkan ID
        $aset = Aset::findOrFail($id);

        // Update data aset dengan data baru dari form
        $aset->nama = $request->input('nama');
        $aset->type = $request->input('type');
        $aset->sn = $request->input('sn');
        $aset->tahun = $request->input('tahun');
        $aset->kondisi = $request->input('kondisi');
        $aset->letak = $request->input('letak');
        $aset->description = $request->input('description');

        // Menghapus gambar lama dan menyimpan gambar baru jika ada
        if ($request->hasFile('gambar')) {
            if ($aset->gambar) {
                $namaAsliGambar = basename($aset->gambar);
                Storage::disk('public')->delete('file_upload/aset/' . $namaAsliGambar);
            }

            $gambar = $request->file('gambar');
            $namaGambar = $gambar->getClientOriginalName();
            $gambar->storeAs('file_upload/aset', $namaGambar, 'public');
            $aset->gambar = 'file_upload/aset/' . $namaGambar;
        }

        // Simpan perubahan
        $aset->save();

        session()->flash('message', 'Aset Berhasil Diupdate');
        return redirect('/admin/aset');
    }

    public function destroy($id)
    {
        $delaset = Aset::find($id);

        // Menghapus file fisik gambar terkait jika ada
        if ($delaset->gambar) {
            Storage::disk('public')->delete($delaset->gambar);
        }

        $delaset->delete();

        session()->flash('message', 'Aset Berhasil Dihapus');
        return redirect('/admin/aset');
    }

    public function cetakAset()
    {
        $data = Aset::all(); // Mengambil data aset dari database

        // Load view dengan data yang diambil dari database
        return view('/admin/aset/cetak_aset', compact('data'));
    }
}
