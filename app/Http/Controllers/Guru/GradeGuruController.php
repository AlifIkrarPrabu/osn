<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeGuruController extends Controller
{
    public function index(Request $request)
    {
        $teacherId = Auth::id();
        
        // Ambil semua kelas yang diajar oleh guru ini melalui data tugasnya
        $classrooms = Classroom::whereHas('assignments', function($q) use ($teacherId) {
            $q->where('teacher_id', $teacherId);
        })->get();

        $selectedClassId = $request->query('class_id');
        $students = collect();
        $assignments = collect();

        if ($selectedClassId) {
            $currentClass = Classroom::findOrFail($selectedClassId);
            
            // Ambil semua siswa di kelas tersebut beserta nilai kuis pilihan gandanya
            $students = $currentClass->students()->with(['submissions' => function($q) use ($selectedClassId) {
                $q->whereHas('assignment', function($innerQ) use ($selectedClassId) {
                    $innerQ->where('classroom_id', $selectedClassId);
                });
            }])->get();

            // Ambil semua daftar tugas yang ada di kelas ini
            $assignments = $currentClass->assignments()->where('teacher_id', $teacherId)->get();
        }

        return view('guru.grades.index', compact('classrooms', 'students', 'assignments', 'selectedClassId'));
    }
}