<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\AdminDashboardController; 
use App\Http\Controllers\UserController; 
use Illuminate\Support\Facades\Route;

// =======================================================
// ROOT ROUTE
// =======================================================
Route::get('/', function () {
    return view('pages.home'); 
});

// Redirect dashboard sesuai role
Route::get('/dashboard', [DashboardController::class, 'redirectBasedOnRole'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =======================================================
// ADMIN AREA
// =======================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::resource('users', UserController::class)->only([
        'index', 'destroy'
    ]);

    // Custom update route
    Route::patch('users/{user}', [UserController::class, 'updateDetails'])
        ->name('users.update_details');

    // CREATE USER (TAMBAHAN BARU)
    Route::post('users', [UserController::class, 'store'])
        ->name('users.store');

    Route::post('/admin/users/store', [UserController::class, 'store'])
        ->name('admin.users.store');
});

// Dashboard Guru
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', function () {
        return view('dashboard.guru');
    })->name('guru.dashboard');
});

// Dashboard Siswa
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', function () {
        return view('dashboard.siswa');
    })->name('siswa.dashboard');
});

require __DIR__.'/auth.php';
