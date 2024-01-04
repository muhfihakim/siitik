<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aplikasi;

class AplikasiController extends Controller
{

    public function index()
    {
        $data = Aplikasi::all();
        return view('admin.datacenter.list_aplikasi', compact('data'));
    }

    public function addAplikasi()
    {
        return view('admin.datacenter.add_aplikasi');
    }

    public function addingAplikasi(Request $request)
    {

        //dd($request->all());
        Aplikasi::create($request->except('_token'));
        session()->flash('message', 'Aplikasi Berhasil Ditambahkan');
        return redirect('/admin/aplikasi/');
    }

    public function editAplikasi($id)
    {
        $aplikasi = Aplikasi::find($id);
        return view('admin.datacenter.edit_aplikasi', compact('aplikasi'));
    }

    public function updateAplikasi($id, Request $request)
    {
        $aplikasi = Aplikasi::find($id);
        $aplikasi->update($request->except('_token'));
        session()->flash('message', 'Aplikasi Berhasil Diupdate');
        return redirect('/admin/aplikasi/');
    }

    public function destroy($id)
    {
        $aplikasi = Aplikasi::find($id);
        $aplikasi->delete();
        session()->flash('message', 'Aplikasi Berhasil Dihapus');
        return redirect('/admin/aplikasi');
    }

    public function monitoringAplikasi()
    {
        $data = Aplikasi::paginate(12); // Ganti angka dengan jumlah item per halaman yang Anda inginkan
        return view('admin.datacenter.monitoring_aplikasi', compact('data'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');

        $data = Aplikasi::where('domain', 'like', "%$keyword%")->paginate(10);

        // Kembalikan tampilan hasil pencarian (gunakan partial view jika perlu)
        return view('admin.datacenter.search_aplikasi', compact('data'));
    }
}
