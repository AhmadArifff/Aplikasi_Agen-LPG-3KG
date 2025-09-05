<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Tambahkan di route atau middleware
Route::fallback(function () {
    return response()->json(['message' => 'Metode tidak diizinkan'], 405);
});

// Add password reset request route
Route::get('/password/request', function () {
    return view('auth.passwords.email'); // Make sure this view exists
})->name('password.request');
Route::get('/perencanaan/pangkalan/{w_id}', [AdminController::class, 'getPangkalanByWilayah']);
// Route::get('/perencanaan/form/pangkalan/{w_id}', [AdminController::class, 'getPangkalanByWilayahTabel']);
Route::get('/perencanaan/pangkalantabel/{wilayahId}', function($wilayahId) {
    return \App\Models\Pangkalan::where('w_id', $wilayahId)->get();
});

// Login (guest only)
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/rekapitulasi', function () {
    return view('admin.layout.rekapitulasi');
});
Route::post('/perencanaan/store', [AdminController::class, 'store']);
Route::post('/admin/perencanaan/import', [AdminController::class, 'importData'])->name('admin.perencanaan.import');

// Dashboard (auth only)
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    
    // Route untuk Perencanaan 
    Route::get('/admin/perencanaan/form', [AdminController::class, 'showPerencanaanForm'])->name('admin.perencanaan.form');
    Route::post('/admin/perencanaan/get', [AdminController::class, 'getPerencanaan'])->name('admin.perencanaan.get');
// Route::post('/admin/perencanaan/import', [AdminController::class, 'importData'])->name('admin.perencanaan.import');
});


// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
