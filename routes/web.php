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
use App\Http\Controllers\Siswa\AnswerController;
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
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // User Management
        Route::resource('users', UserController::class)->only(['index', 'destroy']);
        Route::patch('users/{user}', [UserController::class, 'updateDetails'])->name('users.update_details');
        Route::post('users', [UserController::class, 'store'])->name('users.store');

        // MANAGEMENT MATERI UNTUK ADMIN
        // Menggunakan parameter {id} agar sama dengan yang digunakan di Controller
        Route::resource('materials', MaterialController::class)->parameters([
            'materials' => 'id'
        ]);
    });

// =======================================================
// GURU DASHBOARD
// =======================================================
Route::middleware(['auth', 'role:guru'])
    ->prefix('guru') // Menambahkan prefix agar lebih rapi
    ->name('guru.')
    ->group(function () {

    // DASHBOARD & STUDENTS
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');
    Route::get('/students', [GuruDashboardController::class, 'students'])->name('students');

    // MATERI (Manual Routes)
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create');
    Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
    Route::get('/materials/{id}', [MaterialController::class, 'show'])->name('materials.show');
    Route::get('/materials/{id}/edit', [MaterialController::class, 'edit'])->name('materials.edit');
    Route::patch('/materials/{id}', [MaterialController::class, 'update'])->name('materials.update');
    Route::delete('/materials/{id}', [MaterialController::class, 'destroy'])->name('materials.destroy');
    
    // REPORT
    Route::get('/materials/{id}/report', [MaterialController::class, 'report'])->name('materials.report');

    // TUGAS DALAM MATERI
    Route::post('/materials/{id}/tasks', [MaterialController::class, 'storeTask'])->name('tasks.store');
    Route::put('/tasks/{task}', [MaterialController::class, 'updateTask'])->name('tasks.update');
    Route::delete('/tasks/{task}', [MaterialController::class, 'deleteTask'])->name('tasks.delete');
});

// =======================================================
// SISWA DASHBOARD
// =======================================================
Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.') 
    ->group(function () {

        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
        Route::get('/materials', [SiswaMaterialController::class, 'index'])->name('materials.index');
        Route::get('/materials/{material}', [SiswaMaterialController::class, 'show'])->name('materials.show');

        // Jawaban
        Route::post('/tasks/answer', [TaskAnswerController::class, 'store'])->name('tasks.answer');
        Route::post('/materials/{material}/answers', [AnswerController::class, 'store'])->name('answers.store');
});

require __DIR__.'/auth.php';