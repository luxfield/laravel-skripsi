<?php

use App\Http\Controllers\SuratJalanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SIPBController;
use App\Http\Controllers\SIPBGudangController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;
use Illuminate\Support\Facades\Route;

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



Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'login')->middleware([OnlyGuestMiddleware::class]);
    Route::post('/', 'doLogin')->middleware([OnlyGuestMiddleware::class]);
    Route::get('/logout', 'dologout')->middleware([OnlyMemberMiddleware::class]);
});

Route::middleware([OnlyMemberMiddleware::class])->group(function () {
    Route::get('/app', [HomeController::class, 'index'])->name('home');
    Route::controller(JadwalController::class)->group(function () {
        Route::get('/schedule', 'index')->name('tampil jadwal');
        Route::get('/schedule/add', 'add')->name('tambah jadwal');
        Route::post('/schedule/add', 'add_proses')->name('tambah jadwal proses');
        Route::post('/schedule/search', 'search')->name('cari data jadwal');
        Route::get('/schedule/{id?}/detail', 'detail')
            ->where('id', '(.*)')
            ->name('detail data jadwal');
        Route::post('/schedule/{id?}/detail', 'detail_post')
            ->where('id', '(.*)');
        Route::get('/schedule/{id}/delete', 'delete')
            ->where('id', '(.*)')
            ->name('hapus data jadwal');
        Route::get('/schedule/sjf', 'sjf')->name('sjf data jadwal');
        Route::get('/schedule/{id?}/edit', 'edit')
            ->where('id', '(.*)')
            ->name('edit data jadwal');
        Route::post('/schedule/{id?}/edit', 'doEdit')
            ->where('id', '(.*)')
            ->name('edit data jadwal');
    });

    Route::controller(SuratJalanController::class)->group(function () {
        Route::get('/surat-jalan', 'index')->name('surat jalan');
        Route::get('/surat-jalan/add', 'tambah')->name('tambah barang keluar');
        Route::get('/surat-jalan/cek-slip/{id}/detail', 'cek_slip')->where('id', '(.*)')->name('cek slip barang keluar');
        Route::get('/surat-jalan/cek-sipb/{id}/detail', 'cek_sipb')->where('id', '(.*)')->name('cek sipb barang keluar');
    });

    Route::get('/wilayah', function () {
        return view('wilayah');
    });
    Route::get('/wilayah/add', function () {
        return view('state.add');
    })->name('tambah wilayah');
    Route::get('/pelanggan', function () {
        return view('customer');
    });
    Route::get('/pelanggan/add', function () {
        return view('pelanggan.add');
    })->name('tambah pelanggan');

    Route::resource('kurir', KurirController::class);
    // Route::get('/kurir', [KurirController::class, 'index'])->name('kurir');

    Route::controller(SIPBController::class)->group(function () {
        Route::get('/surat-keluar',  'index')->name('surat-keluar');
        Route::get('/surat-keluar/{id?}/detail',  'detail_sipb')
            ->where('id', '(.*)')
            ->name('detail-surat-keluar');
        Route::get('/surat-keluar/add',  'simpan_index')->name('tambah-surat-keluar');
        Route::post('/schedule/cari', 'dataPelanggan')->name('cari data pelanggan');
        Route::get('/surat-keluar/{id}/hapus',  'hapus')
            ->where('id', '(.*)')
            ->name('hapus-surat-keluar');
        Route::post('/surat-keluar/add',  'simpan')->name('tambah-surat-keluar-proses');
        Route::get('/surat-keluar/autosearch',  'autosearch')->name('autosearch');
        Route::get('/surat-keluar/{id?}/edit',  'edit_index')
            ->where('id', '(.*)')
            ->name('edit surat keluar');
        Route::post('/surat-keluar/{id?}/edit',  'edit_index_proses')
            ->where('id', '(.*)')
            ->name('edit-surat-keluar-proses');
    });


    Route::controller(SIPBGudangController::class)->group(function () {
        Route::get('/sipb', 'index')->name('sipb');
        Route::get('/sipb-disetujui', 'sipb_disetujui')->name('sipb-disetujui');
        Route::get('/sipb-pending', 'sipb_pending')->name('sipb-pending');
        Route::get('/sipb-ditolak', 'sipb_ditolak')->name('sipb-ditolak');
        Route::get('/sipb/{id}/detail', 'detail_sipb')
            ->where('id', '(.*)')
            ->name('detail-sipb');
        Route::get('/sipb/{id}/confirmed', 'confirmed_slip')
            ->where('id', '(.*)')
            ->name('confirmed-slip');
        Route::post('/sipb/{id}/detail', 'detail_sipb_proses')
            ->where('id', '(.*)')
            ->name('detail-sipb-proses');
    });


    Route::controller(LaporanController::class)->group(function () {
        Route::get('/sipb/{id}/print', 'SIPBgeneratePDF')
            ->where('id', '(.*)')
            ->name('print-sipb');
        Route::get('/laporan', 'index')->name('tampil index laporan');
        Route::get('/laporan-slip', 'laporanSlip')->name('tampil slip laporan');
        Route::get('/laporan-sipb', 'laporanSIPB')->name('tampil sipb laporan');
        Route::get('/laporan-penjadwalan', 'laporanPenjadwalan')->name('tampil penjadwalan laporan');
    });
});
