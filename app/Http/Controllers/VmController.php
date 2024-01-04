<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vm;

class VmController extends Controller
{
    public function index()
    {
        $vm = Vm::all();
        return view('admin.datacenter.list_vm', compact(['vm']));
    }

    public function addvm()
    {
        return view('admin.datacenter.add_vm');
    }

    public function addingvm(Request $request)
    {
        //dd($request->all());
        Vm::create($request->except('_token'));
        session()->flash('message', 'VM Berhasil Ditambahkan');
        return redirect('/admin/vm');
    }

    public function editvm($id)
    {
        $vm = Vm::find($id);
        return view('admin.datacenter.edit_vm', compact(['vm']));
    }

    public function updatevm($id, Request $request)
    {
        $vm = Vm::find($id);
        $vm->update($request->except('_token'));
        session()->flash('message', 'VM Berhasil Diupdate');
        return redirect('/admin/vm');
    }

    public function destroy($id)
    {
        $vm = Vm::find($id);
        $vm->delete();
        session()->flash('message', 'VM Berhasil Dihapus');
        return redirect('/admin/vm');
    }

    public function getTotalVM()
    {
        $totalVM = Vm::count(); // Mengambil jumlah total VM dari tabel

        return view('/admin/index', ['totalVM' => $totalVM]);
    }
}
