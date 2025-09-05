<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\HargaKecamatanController;

Route::get('/', function () {
    return view('admin.layout.default');
});
Route::get('/rekapitulasi', [RekapitulasiController::class, 'index'])->name('rekapitulasi.index');
Route::get('/rekapitulasi/data', [RekapitulasiController::class, 'getData'])->name('rekapitulasi.data');

Route::get('/harga-per-kecamatan', [HargaKecamatanController::class, 'index'])
    ->name('harga.kecamatan.index');
