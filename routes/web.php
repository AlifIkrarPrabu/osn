<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\AdminDashboardController; 
use App\Http\Controllers\UserController; 
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule; // Diperlukan jika Rule::unique digunakan di closure route

// =======================================================
// ROOT ROUTE
// =======================================================
Route::get('/', function () {
    return view('pages.home'); 
});

// Route /dashboard dari Breeze (DIGANTI DAN DIARAHKAN ke redirector)
Route::get('/dashboard', [DashboardController::class, 'redirectBasedOnRole'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =======================================================
// ROLE MANAGEMENT ROUTES
// =======================================================

// Grup Rute Admin dengan prefix 'admin' dan name prefix 'admin.'
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // 1. Rute Dashboard Admin (admin.dashboard)
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // 2. Rute Resource untuk User
    // Hanya menggunakan index (daftar) dan destroy (proses hapus)
    // Saya menghapus 'update' dari resource karena akan menggunakan route kustom di bawah.
    Route::resource('users', UserController::class)->only([
        'index', 'destroy'
    ]);
    
    // 3. Rute kustom untuk pembaruan detail (Nama dan Email)
    // Route ini akan dituju oleh form di modal edit
    Route::patch('users/{user}', [UserController::class, 'updateDetails'])
        ->name('users.update_details');
});

// DASHBOARD GURU
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', function () {
        return view('dashboard.guru');
    })->name('guru.dashboard');
});

// DASHBOARD SISWA
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', function () {
        return view('dashboard.siswa');
    })->name('siswa.dashboard');
});

require __DIR__.'/auth.php';