<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\AdminDashboardController; 
use App\Http\Controllers\UserController; 
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\MaterialControllerSiswa;
use App\Http\Controllers\Siswa\TaskAnswerController;
use App\Http\Controllers\Siswa\AnswerController;
use App\Http\Controllers\Guru\ClassController;
use Illuminate\Support\Facades\Route;

// =======================================================
// ROOT ROUTE
// =======================================================
Route::get('/', function () {
    return view('pages.home'); 
});

// Redirect dashboard sesuai role
Route::get('/dashboard', [DashboardController::class, 'redirectBasedOnRole'])
    ->middleware(['auth', 'verified', 'approved'])
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

        // User Management (Terpusat di UserController)
        // Menangani index (tampilan daftar user), store, dan destroy
        Route::resource('users', UserController::class)->only(['index', 'destroy', 'store']);
        
        // Fitur Tambahan User (Update detail, Approve, Reject)
        Route::patch('users/{user}/update-details', [UserController::class, 'updateDetails'])->name('users.update_details');
        Route::patch('users/{user}/approve', [UserController::class, 'approve'])->name('users.approve');
        Route::delete('users/{user}/reject', [UserController::class, 'reject'])->name('users.reject');

        // Management Materi
        Route::resource('materials', MaterialController::class)->parameters([
            'materials' => 'id'
        ]);
    });

// =======================================================
// GURU DASHBOARD
// =======================================================
Route::middleware(['auth', 'role:guru', 'approved'])
    ->prefix('guru') 
    ->name('guru.')
    ->group(function () {

    // Dashboard & Students
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');
    Route::get('/students', [GuruDashboardController::class, 'students'])->name('students');

    // Materi (Menggunakan Resource atau Manual)
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create');
    Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
    Route::get('/materials/{id}', [MaterialController::class, 'show'])->name('materials.show');
    Route::get('/materials/{id}/edit', [MaterialController::class, 'edit'])->name('materials.edit');
    Route::patch('/materials/{id}', [MaterialController::class, 'update'])->name('materials.update');
    Route::delete('/materials/{id}', [MaterialController::class, 'destroy'])->name('materials.destroy');
    
    // Report
    Route::get('/materials/{id}/report', [MaterialController::class, 'report'])->name('materials.report');

    // Tugas Dalam Materi
    Route::post('/materials/{id}/tasks', [MaterialController::class, 'storeTask'])->name('tasks.store');
    Route::put('/tasks/{task}', [MaterialController::class, 'updateTask'])->name('tasks.update');
    Route::delete('/tasks/{task}', [MaterialController::class, 'deleteTask'])->name('tasks.delete');

    // Route Kelas
    Route::get('/classes', [ClassroomController::class, 'index'])->name('classes.index');
    Route::post('/classes', [ClassroomController::class, 'store'])->name('classes.store');
    Route::delete('/classes/{id}', [ClassroomController::class, 'destroy'])->name('classes.destroy');

    // Route Kelola Materi dalam Kelas
    Route::get('/classes/{id}/manage', [ClassroomController::class, 'manageMaterials'])->name('classes.manage');
    Route::post('/classes/{id}/manage', [ClassroomController::class, 'updateMaterials'])->name('classes.update_materials');

    // Route kelola siswa dalam kelas
    Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
    Route::get('/classes/{id}', [ClassController::class, 'show'])->name('classes.show');
    Route::post('/classes/{id}/material', [ClassController::class, 'storeMaterial'])->name('classes.storeMaterial');
    Route::post('/classes/{id}/student', [ClassController::class, 'addStudent'])->name('classes.addStudent');
});

// =======================================================
// SISWA DASHBOARD
// =======================================================
Route::middleware(['auth', 'role:siswa', 'approved'])
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