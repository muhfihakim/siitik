<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermohonanVirtualMeet;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Carbon;

class PermohonanVirtualMeetController extends Controller
{
    public function index()
    {
        $permohonanvirtualmeet = PermohonanVirtualMeet::orderBy('created_at', 'desc')->get();
        return view('admin.virtualmeet.list_permohonan', compact(['permohonanvirtualmeet']));
    }

    public function form()
    {
        return view('admin.virtualmeet.form_virtualmeet');
    }

    public function sendform(Request $request)
    {
        // Validasi formulir
        $this->validate($request, [
            'kebutuhan'         => 'required',
            'nama_opd'          => 'required',
            'nama_pemohon'      => 'required',
            'no_telepon'        => 'required',
            'judul'             => 'required',
            'waktu_pelaksanaan' => 'required',
            'lokasi'            => 'required',
            'partisipan'        => 'required',
            'surat_permohonan'  => 'nullable',
            'surat_perintah'    => 'nullable',
            'description'       => 'nullable',
        ]);

        // Mengambil data file yang diupload jika surat_permohonan tidak kosong
        $file_path = null;
        if ($request->hasFile('surat_permohonan')) {
            $file = $request->file('surat_permohonan');
            // Mengambil nama file asli
            $nama_asli = $file->getClientOriginalName();
            $nama_file = date('d_m_Y') . '_' . $nama_asli;

            // Memindahkan file ke folder tujuan
            $file_path = $file->storeAs('file_upload/suratpermohonan/virtualmeet', $nama_file, 'public');
        }

        $upload = new PermohonanVirtualMeet;
        $upload->jenis             = $request->input('kebutuhan');
        $upload->instansi          = $request->input('nama_opd');
        $upload->pemohon           = $request->input('nama_pemohon');
        $upload->tlp               = $request->input('no_telepon');
        $upload->judul             = $request->input('judul');
        $upload->waktu_pelaksanaan = $request->input('waktu_pelaksanaan');
        $upload->lokasi            = $request->input('lokasi');
        $upload->partisipan        = $request->input('partisipan');
        $upload->surat_permohonan  = $file_path;
        $upload->surat_perintah    = $request->input('surat_perintah');
        $upload->description       = $request->input('description');

        // Menyimpan data ke database
        $upload->save();

        // Mengambil data file yang diupload dan menyesuaikan waktu
        $file = $request->file('surat_permohonan');
        $statusSurat = file_exists($file) ? "Surat Tersedia" : "Surat Tidak Tersedia";
        $waktuPelaksanaan = Carbon::parse($request->input('waktu_pelaksanaan'))->format('j F Y H:i');
        $noTeleponPemohon = $request->input('no_telepon');

        $message = "*Halo Tim!*\n" .
            "=============================\n" .
            "*Ada Permohonan Virtual Meeting Baru.*\n" .
            "=============================\n" .
            "\n" .
            "Kebutuhan: *{$request->input('kebutuhan')}*\n" .
            "Instansi: *{$request->input('nama_opd')}*\n" .
            "Pemohon: *{$request->input('nama_pemohon')}*\n" .
            "No HP: *{$noTeleponPemohon}*\n" . // Nomor telepon sebagai teks
            "Waktu Pelaksanaan: *{$waktuPelaksanaan}*\n" . // Menggunakan format yang diinginkan tanpa nama hari
            "Lokasi: *{$request->input('lokasi')}*\n" .
            "Status Surat: *{$statusSurat}*\n" .
            "\n" .
            "=============================\n" .
            "_Notifikasi Realtime Dari BOT SI-ITIK_\n" .
            "=============================";

        // Menyiapkan inline keyboard
        $inlineKeyboard = [
            [
                [
                    'text' => 'Hubungi/WA Pemohon', 'url' => "https://wa.me/{$noTeleponPemohon}"
                ]
            ]
        ];

        Telegram::sendMessage([
            'chat_id'             => '', // Ganti dengan ID grup Telegram Anda yang diawali dengan tanda negatif
            'text'                => $message,
            'parse_mode'          => 'Markdown',
            'reply_markup'        => json_encode(['inline_keyboard' => $inlineKeyboard]),
            'reply_to_message_id' => 4,
        ]);

        session()->flash('message', 'Permohonan Dukungan Virtual Meeting Berhasil Terkirim.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $delsurat = PermohonanVirtualMeet::find($id);

        // Menghapus file terkait jika ada
        if ($delsurat->surat_permohonan) {
            Storage::disk('public')->delete($delsurat->surat_permohonan);
        }
        if ($delsurat->surat_perintah) {
            Storage::disk('public')->delete($delsurat->surat_perintah);
        }

        $delsurat->delete();

        session()->flash('message', 'Permohonan Berhasil Dihapus');
        return redirect()->back();
    }

    public function uploadSrtPrmhnan(Request $request, $id)
    {
        // Validasi formulir
        $request->validate([
            'surat_permohonan' => 'required|mimes:pdf,doc,docx|max:2048', // Sesuaikan dengan jenis file yang diizinkan
        ]);

        // Mengambil data file yang diupload
        $file = $request->file('surat_permohonan');
        // Mengambil nama file asli
        $nama_asli = $file->getClientOriginalName();
        $nama_file = date('d_m_Y') . '_' . $nama_asli;

        // Memindahkan file ke folder tujuan
        $file_path = $file->storeAs('file_upload/suratpermohonan/virtualmeet', $nama_file, 'public');

        // Simpan informasi upload ke database
        $permohonan = PermohonanVirtualMeet::find($id);
        $permohonan->surat_permohonan = $file_path;
        $permohonan->save();

        // Flash message
        session()->flash('message', 'Surat Permohonan berhasil diupload.');

        return redirect()->back();
    }

    public function uploadSP(Request $request, $id)
    {
        // Validasi formulir
        $request->validate([
            'surat_perintah' => 'required|mimes:pdf,doc,docx|max:2048', // Sesuaikan dengan jenis file yang diizinkan
        ]);

        // Mengambil data file yang diupload
        $file = $request->file('surat_perintah');
        // Mengambil nama file asli
        $nama_asli = $file->getClientOriginalName();
        $nama_file = date('d_m_Y') . '_' . $nama_asli;

        // Memindahkan file ke folder tujuan
        $file_path = $file->storeAs('file_upload/suratperintah/virtualmeet', $nama_file, 'public');

        // Simpan informasi upload ke database
        $permohonan = PermohonanVirtualMeet::find($id);
        $permohonan->surat_perintah = $file_path;
        $permohonan->save();

        // Flash message
        session()->flash('message', 'Surat Perintah berhasil diupload.');

        return redirect()->back();
    }

    public function getDetail($id)
    {
        // Ambil data detail dari database berdasarkan ID
        $detail = PermohonanVirtualMeet::find($id);

        // Sesuaikan dengan struktur data dan tampilkan konten HTML
        $html = "<style type='text/css'>
            .tg  {border-collapse: collapse; border-spacing: 0;}
            .tg td {border-color: black; border-style: solid; border-width: 1px; font-family: Arial, sans-serif; font-size: 14px; overflow: hidden; padding: 10px 5px; word-break: normal;}
            .tg th {border-color: black; border-style: solid; border-width: 1px; font-family: Arial, sans-serif; font-size: 14px; font-weight: normal; overflow: hidden; padding: 10px 5px; word-break: normal;}
            .tg .tg-9wq8 {border-color: inherit; text-align: center; vertical-align: middle}
            .tg .tg-0pky {border-color: inherit; text-align: left; vertical-align: top}
        </style>
        <table class='tg' style='undefined; table-layout: fixed; width: 100%'>
            <colgroup>
                <col style='width: 101px'>
                <col style='width: 212px'>
            </colgroup>
            <thead>
                <tr>
                    <th class='tg-9wq8' colspan='2'>Detail Permohonan Virtual Meeting</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class='tg-0pky'>Jenis</td>
                    <td class='tg-0pky'>$detail->jenis</td>
                </tr>
                <tr>
                    <td class='tg-0pky'>Instansi</td>
                    <td class='tg-0pky'>$detail->instansi</td>
                </tr>
                <tr>
                    <td class='tg-0pky'>Pemohon</td>
                    <td class='tg-0pky'>$detail->pemohon</td>
                </tr>
                <tr>
                    <td class='tg-0pky'>Tlp/WA</td>
                    <td class='tg-0pky'><a href='https://wa.me/$detail->tlp' target='_blank'>$detail->tlp</a></td>
                </tr>
                <tr>
                    <td class='tg-0pky'>Judul</td>
                    <td class='tg-0pky'>$detail->judul</td>
                </tr>
                <tr>
                    <td class='tg-0pky'>Waktu</td>
                    <td class='tg-0pky'>$detail->waktu_pelaksanaan</td>
                </tr>
                <tr>
                    <td class='tg-0pky'>Lokasi</td>
                    <td class='tg-0pky'>$detail->lokasi</td>
                </tr>
                <tr>
                    <td class='tg-0pky'>Partisipan</td>
                    <td class='tg-0pky'>$detail->partisipan</td>
                </tr>
                <tr>
                    <td class='tg-0pky'>Keterangan</td>
                    <td class='tg-0pky'>$detail->description</td>
                </tr>
            </tbody>";

        return response()->json(['detail' => $html]);
    }

    public function convertZoom()
    {
        return view('admin.virtualmeet.convert_zoom');
    }

    public function convert(Request $request)
    {
        $teksZoom = $request->input('zoomText');
        $hasilKonversi = $this->convertZoomText($teksZoom);

        return view('admin.virtualmeet.convert_zoom', ['hasilKonversi' => $hasilKonversi]);
    }

    private function convertZoomText($teksZoom)
    {
        // Pisahkan teks menjadi baris-baris
        $barisTeks = explode("\n", $teksZoom);

        // Ambil informasi penting
        $topic = null;
        $waktuLine = null;
        foreach ($barisTeks as $line) {
            if (strpos($line, 'Topic:') === 0) {
                $topic = trim(str_replace('Topic:', '', $line));
            } elseif (strpos($line, 'Time:') === 0) {
                $waktuLine = $line;
            }
        }

        if (!$topic || !$waktuLine) {
            return "Format teks Zoom Invitation tidak valid.";
        }

        $waktuRaw = trim(str_replace('Time:', '', $waktuLine));

        // Mencari link Zoom menggunakan ekspresi reguler
        $linkZoom = $this->findZoomLink($barisTeks);

        $meetingID = null;
        $passcode = null;

        foreach ($barisTeks as $line) {
            if (strpos($line, 'Meeting ID:') === 0) {
                $meetingID = trim(str_replace('Meeting ID:', '', $line));
            } elseif (strpos($line, 'Passcode:') === 0) {
                $passcode = trim(str_replace('Passcode:', '', $line));
            }
        }

        // Ambil Hari, Tanggal, dan Pukul
        $waktuArray = explode(' ', $waktuRaw);
        $bulan = $waktuArray[0];
        $tanggal = str_replace(',', '', $waktuArray[1]); // Hapus koma pada tanggal
        $tahun = $waktuArray[2];
        $pukul = $waktuArray[3];

        // Ganti bagian ini sesuai dengan informasi yang tepat
        $bulanIndonesia = $this->mapBulanToIndonesia($bulan);
        $namaHari = $this->getNamaHari($tanggal, $bulan, $tahun);

        $formatTujuan = "Kepada Yth:\nBapak/Ibu ..........................\n\nAkan diadakan Video Conference dengan agenda sebagai berikut:\n\n*$topic*\n\nHari             :  $namaHari\nTanggal       :  $tanggal $bulanIndonesia $tahun\nPukul           :  $pukul WIB s/d Selesai\n\nMeeting ID   : $meetingID\nPasscode     : $passcode\n\nLink Zoom Meeting :\n$linkZoom\n\n\nDemikian untuk maklum dan mohon kerjasamanya.\nTerima kasih.\n\n*.... Kab. Subang*";

        // Simpan pesan dalam sesi flash
        $message = "Format teks Undangan Virtual Meeting berhasil dikonversi.";
        Session::flash('success', $message);

        // Tampilkan hasil konversi
        return $formatTujuan;
    }

    private function mapBulanToIndonesia($bulan)
    {
        // Fungsi untuk memetakan nama bulan Inggris ke nama bulan Indonesia
        $mapBulan = [
            'Jan' => 'Januari',
            'Feb' => 'Februari',
            'Mar' => 'Maret',
            'Apr' => 'April',
            'May' => 'Mei',
            'Jun' => 'Juni',
            'Jul' => 'Juli',
            'Aug' => 'Agustus',
            'Sep' => 'September',
            'Oct' => 'Oktober',
            'Nov' => 'November',
            'Dec' => 'Desember',
        ];
        return $mapBulan[$bulan] ?? $bulan;
    }

    private function getNamaHari($tanggal, $bulan, $tahun)
    {
        // Fungsi untuk mendapatkan nama hari dalam bahasa Indonesia dari tanggal, bulan, dan tahun
        $timestamp = strtotime("$tahun-$bulan-$tanggal");
        $namaHari = date("l", $timestamp);

        // Ganti nama hari dalam bahasa Indonesia
        $namaHariIndonesia = '';
        switch ($namaHari) {
            case 'Sunday':
                $namaHariIndonesia = 'Minggu';
                break;
            case 'Monday':
                $namaHariIndonesia = 'Senin';
                break;
            case 'Tuesday':
                $namaHariIndonesia = 'Selasa';
                break;
            case 'Wednesday':
                $namaHariIndonesia = 'Rabu';
                break;
            case 'Thursday':
                $namaHariIndonesia = 'Kamis';
                break;
            case 'Friday':
                $namaHariIndonesia = 'Jumat';
                break;
            case 'Saturday':
                $namaHariIndonesia = 'Sabtu';
                break;
            default:
                $namaHariIndonesia = $namaHari;
                break;
        }

        return $namaHariIndonesia;
    }
    private function findZoomLink($barisTeks)
    {
        foreach ($barisTeks as $line) {
            // Mencari link Zoom menggunakan ekspresi reguler
            if (preg_match('/https:\/\/zoom\.us\/j\/\d+\?pwd=\w+/', $line, $matches)) {
                return $matches[0];
            }
        }

        return '';
    }
}
