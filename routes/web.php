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
use App\Http\Controllers\Siswa\SiswaClassController;
use App\Http\Controllers\Guru\ClassController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guru\AssignmentController;
use App\Http\Controllers\Siswa\AssignmentSiswaController;
use App\Http\Controllers\Siswa\GradeSiswaController;
use App\Http\Controllers\Guru\GradeGuruController;
use App\Http\Controllers\Guru\DiscussionGuruController;
use App\Http\Controllers\Siswa\DiscussionSiswaController;
use App\Http\Controllers\Guru\CalendarGuruController;
use App\Http\Controllers\Siswa\CalendarSiswaController;

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
// GURU
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

    //Assignments Guru
    Route::resource('assignments', AssignmentController::class);
    Route::post('submissions/{submission}/grade', [AssignmentController::class, 'grade'])->name('submissions.grade');

    //Grades Guru
    Route::get('/grades', [GradeGuruController::class, 'index'])->name('grades.index');

    //Discussions Guru
    Route::get('/discussions', [DiscussionGuruController::class, 'index'])->name('discussions.index');
    Route::post('/discussions/topic', [DiscussionGuruController::class, 'storeTopic'])->name('discussions.store_topic');
    Route::get('/discussions/{id}', [DiscussionGuruController::class, 'show'])->name('discussions.show');
    Route::post('/discussions/{id}/reply', [DiscussionGuruController::class, 'storeReply'])->name('discussions.store_reply');
    Route::delete('/discussions/{id}', [DiscussionGuruController::class, 'destroyTopic'])->name('discussions.destroy_topic');

    //Calendar Guru
    Route::get('/calendar', [CalendarGuruController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/events', [CalendarGuruController::class, 'getEvents'])->name('calendar.events');
    Route::post('/calendar/event', [CalendarGuruController::class, 'storeEvent'])->name('calendar.store_event');
    Route::delete('/calendar/event/{id}', [CalendarGuruController::class, 'destroyEvent'])->name('calendar.destroy_event');
});

// =======================================================
// SISWA
// =======================================================
Route::middleware(['auth', 'role:siswa', 'approved'])
    ->prefix('siswa')
    ->name('siswa.') 
    ->group(function () {

        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
        Route::get('/materials', [MaterialControllerSiswa::class, 'index'])->name('materials.index');
        Route::get('/materials/{material}', [MaterialControllerSiswa::class, 'show'])->name('materials.show');

        // Jawaban
        Route::post('/tasks/answer', [TaskAnswerController::class, 'store'])->name('tasks.answer');
        Route::post('/materials/{material}/answers', [AnswerController::class, 'store'])->name('answers.store');

        //Kelas Siswa
        Route::get('/classes', [SiswaClassController::class, 'index'])->name('classes.index');

        //Assignments Siswa
        Route::get('/assignments', [AssignmentSiswaController::class, 'index'])->name('assignments.index');
        Route::get('/assignments/{assignment}', [AssignmentSiswaController::class, 'show'])->name('assignments.show');
        Route::post('/assignments/{assignment}/submit', [AssignmentSiswaController::class, 'store'])->name('assignments.submit');

        //Grades Siswa
        Route::get('/grades', [GradeSiswaController::class, 'index'])->name('grades.index');

        //Discussions Siswa
        Route::get('/discussions', [DiscussionSiswaController::class, 'index'])->name('discussions.index');
        Route::post('/discussions/topic', [DiscussionSiswaController::class, 'storeTopic'])->name('discussions.store_topic');
        Route::get('/discussions/{id}', [DiscussionSiswaController::class, 'show'])->name('discussions.show');
        Route::post('/discussions/{id}/reply', [DiscussionSiswaController::class, 'storeReply'])->name('discussions.store_reply');

        //Calendar Siswa
        Route::get('/calendar', [CalendarSiswaController::class, 'index'])->name('calendar.index');
        Route::get('/calendar/events', [CalendarSiswaController::class, 'getEvents'])->name('calendar.events');
        });

require __DIR__.'/auth.php';