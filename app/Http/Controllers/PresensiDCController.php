<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PresensiDC;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Telegram\Bot\Laravel\Facades\Telegram;

class PresensiDCController extends Controller
{
    public function index()
    {
        return view('admin.datacenter.presensi_pusatdata');
    }

    public function compressAndSaveImageGD($sourcePath, $destinationPath, $quality = 60)
    {
        $info = getimagesize($sourcePath);

        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($sourcePath);
            imagejpeg($image, $destinationPath, $quality);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($sourcePath);
            imagepng($image, $destinationPath, round(9 * $quality / 100));
        } elseif ($info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($sourcePath);
            imagegif($image, $destinationPath);
        }

        imagedestroy($image);

        return $destinationPath;
    }

    public function store(Request $request)
    {
        // Validasi data
        $this->validate($request, [
            'nama_lengkap'     => 'required',
            'instansi'         => 'required',
            'kotakab'          => 'required',
            'jenis_identitas'  => 'required',
            'no_identitas'     => 'required',
            'no_badge'         => 'nullable',
            'tanggal'          => 'required',
            'jam_masuk'        => 'required',
            'jam_keluar'       => 'required',
            'tujuan'           => 'required',
            'keluar_perangkat' => 'nullable',
            'masuk_perangkat'  => 'nullable',
            'keterangan'       => 'nullable',
            'selfie'           => 'required',
            'ttd'              => 'required',
        ]);

        $selfie_path = null;
        if ($request->hasFile('selfie')) {
            $selfie = $request->file('selfie');
            $nama_asli_selfie = $selfie->getClientOriginalName();

            // Menentukan nama file selfie dengan menggunakan Str::random
            $nama_file_selfie = Str::random(5) . '_selfie_' . str_replace('', '_', $nama_asli_selfie);

            // Mengkompres dan menyimpan file selfie menggunakan GD
            $compressedPath = $this->compressAndSaveImageGD($selfie->getRealPath(), storage_path('app/public/file_upload/datacenter/selfie/' . $nama_file_selfie));

            // Menyimpan path yang sudah dikompres
            Storage::put('public/file_upload/datacenter/selfie/' . $nama_file_selfie, file_get_contents($compressedPath));


            // Set path yang sudah dikompres ke variabel $selfie_path
            $selfie_path = 'file_upload/datacenter/selfie/' . $nama_file_selfie;
        }

        $ttd_path = null;
        if ($request->has('ttd')) {
            $ttd_base64 = $request->input('ttd');
            $ttd_base64_parts = explode(',', $ttd_base64);
            $ttd_data = base64_decode($ttd_base64_parts[1]);

            // Menentukan nama file tandatangan
            $nama_lengkap = $request->input('nama_lengkap'); // Mengambil nilai dari form "nama_lengkap"
            $nama_file_ttd = Str::random(5) . '_ttd_' . str_replace(' ', '_', $nama_lengkap) . '.png';

            // Menyimpan file tandatangan ke penyimpanan yang telah dikonfigurasi
            Storage::put('public/file_upload/datacenter/ttd/' . $nama_file_ttd, $ttd_data);

            // Set path untuk tanda tangan
            $ttd_path = 'file_upload/datacenter/ttd/' . $nama_file_ttd;
        }

        $upload = new PresensiDC;
        $upload->nama_lengkap     = $request->input('nama_lengkap');
        $upload->instansi         = $request->input('instansi');
        $upload->kotakab          = $request->input('kotakab');
        $upload->jenis_identitas  = $request->input('jenis_identitas');
        $upload->no_identitas     = $request->input('no_identitas');
        $upload->no_badge         = $request->input('no_badge');
        $upload->tanggal          = $request->input('tanggal');
        $upload->jam_masuk        = $request->input('jam_masuk');
        $upload->jam_keluar       = $request->input('jam_keluar');
        $upload->tujuan           = $request->input('tujuan');
        $upload->keluar_perangkat = $request->input('keluar_perangkat');
        $upload->masuk_perangkat  = $request->input('masuk_perangkat');
        $upload->keterangan       = $request->input('keterangan');
        $upload->selfie           = $selfie_path;
        $upload->ttd              = $ttd_path;

        // Menyimpan data ke database
        $upload->save();

        $message = "*Halo Tim!*\n" .
            "=============================\n" .
            "*Ada Presensi Data Center Masuk.*\n" .
            "=============================\n" .
            "\n" .
            "Nama: *{$request->input('nama_lengkap')}*\n" .
            "Instansi: *{$request->input('instansi')}*\n" .
            "Kota/Kab: *{$request->input('kotakab')}*\n" .
            "Masuk: *{$request->input('jam_masuk')}*\n" .
            "Keluar: *{$request->input('jam_keluar')}*\n" .
            "Tujuan: *{$request->input('tujuan')}*\n" .
            "\n" .
            "=============================\n" .
            "_Notifikasi Realtime Dari BOT SI-ITIK_\n" .
            "=============================";

        Telegram::sendMessage([
            'chat_id'             => '', // Ganti dengan ID grup Telegram Anda yang diawali dengan tanda negatif
            'text'                => $message,
            'parse_mode'          => 'Markdown',
            'reply_to_message_id' => 3, // ID
        ]);

        session()->flash('message', 'Presensi Anda Berhasil Dilakukan.');
        return redirect()->back();
    }

    public function listpresensi()
    {
        $presensi = PresensiDC::orderBy('created_at', 'desc')->get();
        return view('admin.datacenter.list_presensi', compact(['presensi']));
    }

    public function cetak_presensi(Request $request): View
    {
        $bulan = $request->bulan;
        $data = PresensiDC::whereMonth('tanggal', $bulan)->get();

        return view('admin.datacenter.cetak_presensi', compact('bulan', 'data'));
    }
}
