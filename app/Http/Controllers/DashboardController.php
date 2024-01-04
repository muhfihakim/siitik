<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vm;
use App\Models\Network;
use App\Models\Aset;
use App\Models\PermohonanVirtualMeet;
use App\Models\PresensiDC;
use App\Models\Aplikasi;

class DashboardController extends Controller
{
    public function getTotalData()
    {
        $totalVM        = Vm::count();
        $totalAset      = Aset::count();
        $totalNetwork   = Network::count();
        $totalVirtualMeet = PermohonanVirtualMeet::count();
        $totalPresensiDC = PresensiDC::count();
        $totalAplikasi = Aplikasi::count();

        return view('/admin/index', [
            'totalVM' => $totalVM,
            'totalAset' => $totalAset,
            'totalNetwork' => $totalNetwork,
            'totalVirtualMeet' => $totalVirtualMeet,
            'totalPresensiDC' => $totalPresensiDC,
            'totalAplikasi' => $totalAplikasi,
        ]);
    }
}
