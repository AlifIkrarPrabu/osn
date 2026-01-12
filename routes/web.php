<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\AdminDashboardController; 
use App\Http\Controllers\UserController; 
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\MaterialController as SiswaMaterialController;
use App\Http\Controllers\Siswa\TaskAnswerController;
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
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // User Management
        Route::resource('users', UserController::class)->only([
            'index', 'destroy'
        ]);

        // Custom update route
        Route::patch('users/{user}', [UserController::class, 'updateDetails'])
            ->name('users.update_details');

        // CREATE USER
        Route::post('users', [UserController::class, 'store'])
            ->name('users.store');

        Route::post('/admin/users/store', [UserController::class, 'store'])
            ->name('admin.users.store');
    });

// =======================================================
// GURU DASHBOARD (DINAMIS + MATERI & TUGAS)
// =======================================================
Route::middleware(['auth', 'role:guru'])->group(function () {

    // DASHBOARD GURU
    Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])
        ->name('guru.dashboard');

    // ✨ HALAMAN DAFTAR SISWA
    Route::get('/guru/students', [GuruDashboardController::class, 'students'])
        ->name('guru.students');

    // ===================================================
    // ✨ MATERI
    // ===================================================
    Route::get('/guru/materials', [MaterialController::class, 'index'])
        ->name('guru.materials.index');

    Route::get('/guru/materials/create', [MaterialController::class, 'create'])
        ->name('guru.materials.create');

    Route::post('/guru/materials', [MaterialController::class, 'store'])
        ->name('guru.materials.store');

    Route::get('/guru/materials/{id}', [MaterialController::class, 'show'])
        ->name('guru.materials.show');

    Route::get('/guru/materials/{id}/edit', [MaterialController::class, 'edit'])
        ->name('guru.materials.edit');

    Route::patch('/guru/materials/{id}', [MaterialController::class, 'update'])
        ->name('guru.materials.update');

    Route::delete('/guru/materials/{id}', [MaterialController::class, 'destroy'])
        ->name('guru.materials.destroy');

    // ===================================================
    // ✨ TUGAS DALAM MATERI (Pilihan Ganda / Essay)
    // ===================================================
    Route::post('/guru/materials/{id}/tasks', [MaterialController::class, 'storeTask'])
        ->name('guru.tasks.store');

    // TASKS AJAX
    Route::post('/guru/materials/task/{taskId}/update', [MaterialController::class, 'updateTask'])
        ->name('guru.tasks.update');

    Route::delete('/guru/materials/task/{taskId}/delete', [MaterialController::class, 'deleteTask'])
        ->name('guru.tasks.delete');

});

// =======================================================
// SISWA DASHBOARD
// =======================================================
Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {

        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/materials/{material}', [SiswaMaterialController::class, 'show'])
            ->name('materials.show');

        Route::post('/tasks/answer', [TaskAnswerController::class, 'store'])
            ->name('tasks.answer');
});

require __DIR__.'/auth.php';
