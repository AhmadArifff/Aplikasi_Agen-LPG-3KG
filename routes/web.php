<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekapitulasiController;

Route::get('/rekapitulasi', [RekapitulasiController::class, 'index'])->name('rekapitulasi.index');

Route::get('/rekapitulasi/data', [RekapitulasiController::class, 'getData'])->name('rekapitulasi.data');

Route::get('/', function () {
    return view('admin.layout.default');
});
