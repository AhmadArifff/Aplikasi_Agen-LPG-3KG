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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Add password reset request route
Route::get('/password/request', function () {
    return view('auth.passwords.email'); // Make sure this view exists
})->name('password.request');

Route::get('/', function () {
    return view('admin.layout.default');
});
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard'); // buat view dashboard.blade.php
    })->name('dashboard');
});

