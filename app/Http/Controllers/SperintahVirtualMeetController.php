<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SperintahVirtualMeet;
use App\Models\SpermohonanVirtualMeet;
use Illuminate\Support\Facades\Storage;

class SperintahVirtualMeetController extends Controller
{
    public function index()
    {
        $sperintahvirtualmeet = Sperintahvirtualmeet::all();
        return view('admin.virtualmeet.suratperintah.sperintah', compact(['sperintahvirtualmeet']));
    }

    public function addsurat()
    {
        $options = Spermohonanvirtualmeet::distinct('perihal')->pluck('perihal');
        return view('admin.virtualmeet.suratperintah.addsurat', compact('options'));
    }

    public function addingsurat(Request $request)
    {
        // Validasi data yang dikirim dari form
        $this->validate($request, [
            'perihal' => 'required',
            'tgl_keluar' => 'required',
            'file' => 'required',
            'description' => 'nullable',
        ]);

        // Mengambil data file yang diupload
        $file = $request->file('file');
        // Mengambil nama file asli
        $nama_asli = $file->getClientOriginalName();
        $nama_file = date('d_m_Y') . '_' . $nama_asli;

        // Memindahkan file ke folder tujuan
        $file_path = $file->storeAs('file_upload/suratperintah/virtualmeet', $nama_file, 'public');

        $upload = new SperintahVirtualMeet;
        $upload->perihal = $request->input('perihal');
        $upload->tgl_keluar = $request->input('tgl_keluar');
        $upload->file = $file_path;
        $upload->description = $request->input('description');

        // Menyimpan data ke database
        $upload->save();

        session()->flash('message', 'Surat Perintah Berhasil Ditambahkan');
        return redirect('/admin/sperintah');
    }

    public function editsurat($id)
    {
        $editsurat = SperintahVirtualMeet::find($id);
        return view('admin.virtualmeet.suratperintah.editsurat', compact(['editsurat']));
    }

    public function updatesurat($id, Request $request)
    {
        // Menemukan data surat berdasarkan ID
        $editsurat = SperintahVirtualMeet::find($id);

        // Melakukan validasi data yang diubah
        $this->validate($request, [
            'perihal' => 'required',
            'tgl_keluar' => 'required',
            'description' => 'nullable',
        ]);

        // Memeriksa apakah ada file yang diunggah
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $nama_asli = $file->getClientOriginalName();
            $nama_file = date('d_m_Y') . '_' . $nama_asli;

            $file_path = $file->storeAs('file_upload/suratperintah/virtualmeet', $nama_file, 'public');

            // Menghapus file sebelumnya jika ada
            if ($editsurat->file) {
                Storage::disk('public')->delete($editsurat->file);
            }

            $editsurat->file = $file_path;
        }

        // Mengupdate data surat
        $editsurat->perihal = $request->input('perihal');
        $editsurat->tgl_keluar = $request->input('tgl_keluar');
        $editsurat->description = $request->input('description');
        $editsurat->save();

        session()->flash('message', 'Surat Perintah Berhasil Diupdate');
        return redirect('/admin/sperintah');
    }

    public function destroy($id)
    {
        $delsurat = SperintahVirtualMeet::find($id);

        // Menghapus file fisik terkait jika ada
        if ($delsurat->file) {
            Storage::disk('public')->delete($delsurat->file);
        }

        $delsurat->delete();

        session()->flash('message', 'Surat Perintah Berhasil Dihapus');
        return redirect('/admin/sperintah');
    }
}
