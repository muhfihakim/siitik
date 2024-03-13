<?php

use App\Http\Controllers\AplikasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VmController;
use App\Http\Controllers\PermohonanVirtualMeetController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\PresensiDCController;
use App\Http\Controllers\SesiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/form_virtualmeet', [PermohonanVirtualMeetController::class, 'form'])->name('form.virtualmeet'); //form permohonan virtual meet
Route::post('/admin/sendpermohonan', [PermohonanVirtualMeetController::class, 'sendform'])->name('send.form.virtualmeet'); // send permohonan virtual meet
Route::get('/presensi_pusatdata', [PresensiDCController::class, 'index'])->name('form.presensi.pusatdata'); //form presensi pusat data
Route::post('/admin/sendpresensi', [PresensiDCController::class, 'store'])->name('send.form.presensi.pusatdata'); //send presensi pusat data
Route::get('/convert_link', [PermohonanVirtualMeetController::class, 'convert_link'])->name('convert_link'); //konversi virtual meet
Route::post('/convert-link-done', [PermohonanVirtualMeetController::class, 'convert2'])->name('convert2'); //hasil konversi virtual meet

// ROUTE GUEST
Route::middleware(['guest'])->group(function () {

    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
});

// ROUTE DASHBOARD
Route::get('/home', function () {
    return redirect('/dash');
})->name('dashboard');

// ROUTE KETIKA SUDAH LOGIN
Route::middleware(['auth'])->group(function () {

    Route::get('/dash', function () {
        return view('admin/index');
    });
    // ROUTE LOGOUT
    Route::get('/logout', [SesiController::class, 'logout'])->name('logout');

    // ROUTE TOTAL DATA
    Route::get('/dash', [DashboardController::class, 'getTotalData']);

    // ROUTE DATACENTER
    Route::get('/admin/vm', [VmController::class, 'index'])->name('index.vm'); //index list vm
    Route::get('/admin/vm/addvm', [VmController::class, 'addvm'])->name('add.vm'); //add vm
    Route::post('/admin/vm/addingvm', [VmController::class, 'addingvm'])->name('adding.vm'); //process adding vm
    Route::get('/admin/vm/{id}/editvm', [VmController::class, 'editvm'])->name('edit.vm'); //edit vm
    Route::put('/admin/vm/{id}', [VmController::class, 'updatevm']); //update vm
    Route::delete('/admin/vm/{id}', [VmController::class, 'destroy']); //delete vm
    Route::get('/admin/list_presensi', [PresensiDCController::class, 'listpresensi'])->name('index.presensi'); //index list presensi
    Route::post('/admin/list_presensi/cetak_presensi', [PresensiDCController::class, 'cetak_presensi'])->name('cetak.presensi'); //export presensi
    Route::get('/admin/aplikasi', [AplikasiController::class, 'index'])->name('index.aplikasi'); //index list aplikasi
    Route::get('/admin/aplikasi/add_aplikasi', [AplikasiController::class, 'addAplikasi'])->name('add.aplikasi'); //add aplikasi
    Route::post('/admin/aplikasi/addingaplikasi', [AplikasiController::class, 'addingAplikasi'])->name('adding.aplikasi'); //adding aplikasi
    Route::get('/admin/aplikasi/{id}/editaplikasi', [AplikasiController::class, 'editAplikasi'])->name('edit.aplikasi'); //edit aplikasi
    Route::put('/admin/aplikasi/{id}', [AplikasiController::class, 'updateAplikasi'])->name('update.aplikasi'); //update aplikasi
    Route::delete('/admin/aplikasi/{id}', [AplikasiController::class, 'destroy'])->name('destroy.aplikasi'); //delete aplikasi
    Route::get('/admin/aplikasi/monitoring', [AplikasiController::class, 'monitoringAplikasi'])->name('monitoring.aplikasi');
    Route::get('/admin/aplikasi/monitoring/search', [AplikasiController::class, 'search'])->name('search'); //search monitoring aplikasi


    // ROUTE PERMOHONAN VIRTUAL MEETING
    Route::get('/admin/virtualmeet', [PermohonanVirtualMeetController::class, 'index'])->name('index.virtualmeet'); //index list surat permohonan
    Route::post('/admin/virtualmeet/{id}/upsrtprmhnan', [PermohonanVirtualMeetController::class, 'uploadSrtPrmhnan']); //process upload surat permohonan
    Route::post('/admin/virtualmeet/{id}/upsp', [PermohonanVirtualMeetController::class, 'uploadSP']); //process upload sp
    Route::get('/get-detail/{id}', [PermohonanVirtualMeetController::class, 'getDetail']);
    Route::delete('/admin/virtualmeet/{id}', [PermohonanVirtualMeetController::class, 'destroy']); //delete permohonan
    Route::get('/admin/virtualmeet/convert-link', [PermohonanVirtualMeetController::class, 'convertZoom'])->name('convert.link');
    Route::post('/admin/virtualmeet/convert-link-done', [PermohonanVirtualMeetController::class, 'convert'])->name('convert');
    // Route::get('/admin/spermohonan/addsurat', [SpermohonanVirtualMeetController::class, 'addsurat']); //add surat
    // Route::post('/admin/spermohonan/addingsurat', [SpermohonanVirtualMeetController::class, 'addingsurat']); //process adding surat
    // Route::get('/admin/spermohonan/{id}/editsurat', [SpermohonanVirtualMeetController::class, 'editsurat']); //edit surat
    // Route::put('/admin/spermohonan/{id}', [SpermohonanVirtualMeetController::class, 'updatesurat']); //update surat
    // Route::delete('/admin/spermohonan/{id}', [SpermohonanVirtualMeetController::class, 'destroy']); //delete surat

    // ROUTE ASET
    Route::get('/admin/aset', [AsetController::class, 'index'])->name('index.aset'); //index list aset
    Route::get('/admin/aset/addaset', [AsetController::class, 'addaset'])->name('add.aset'); //add aset
    Route::post('/admin/aset/addingaset', [AsetController::class, 'addingaset'])->name('adding.aset'); //adding aset
    Route::get('/admin/aset/{id}/editaset', [AsetController::class, 'editaset'])->name('edit.aset'); //edit aset
    Route::put('/admin/aset/{id}', [AsetController::class, 'updateaset'])->name('update.aset'); //update aset
    Route::delete('/admin/aset/{id}', [AsetController::class, 'destroy']); //delete aset
    Route::get('/admin/aset/cetak_aset', [AsetController::class, 'cetakAset'])->name('cetak.aset'); //export aset

    // ROUTE NETWORK
    Route::get('/admin/network', [NetworkController::class, 'index'])->name('index.network'); //index list network
    Route::get('/admin/network/addnetwork', [NetworkController::class, 'addnetwork'])->name('add.network'); //add network
    Route::post('/admin/network/addingnetwork', [NetworkController::class, 'addingnetwork'])->name('adding.network'); //process adding network
    Route::get('/admin/network/{id}/editnetwork', [NetworkController::class, 'editnetwork']); // edit network
    Route::put('/admin/network/{id}', [NetworkController::class, 'updatenetwork']); //update network
    Route::delete('/admin/network/{id}', [NetworkController::class, 'destroy']); //delete network
    Route::get('/admin/network/form_instalasi', [NetworkController::class, 'formInstalasi'])->name('form.instalasi.network');
    Route::post('/admin/network/generate_form', [NetworkController::class, 'generateForm'])->name('generate.form');


    //  Route::get('/admin/network/ba/', [NetworkController::class, 'formBa']);
    // Route::post('/adming/network/generateba/', [NetworkController::class, 'generatePDF'])->name('generate.pdf');

    //ROUTE CHANGELOGS
    Route::get('/admin/changelogs', [ChangelogsController::class, 'index'])->name('index.changelogs');
});
