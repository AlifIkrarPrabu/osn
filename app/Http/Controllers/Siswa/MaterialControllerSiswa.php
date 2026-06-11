<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Classroom;
use App\Models\ExamSession;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialControllerSiswa extends Controller
{
    public function index(Request $request)
    {
        $classId = $request->query('class_id');
        
        if ($classId) {
            // Ambil materi hanya untuk kelas tertentu
            $classroom = Classroom::findOrFail($classId);
            $materials = $classroom->materials()->with('user')->latest()->get();
            $title = "Materi Kelas: " . $classroom->name;
        } else {
            // Jika tidak ada parameter, ambil materi dari semua kelas yang diikuti siswa
            $user = Auth::user();
            $classIds = $user->classrooms->pluck('id');
            
            $materials = Material::whereHas('classrooms', function($q) use ($classIds) {
                $q->whereIn('classrooms.id', $classIds);
            })->with('user')->latest()->get();
            
            $title = "Semua Materi Saya";
        }

        return view('siswa.materials.index', compact('materials', 'title'));
    }

    public function show(Material $material)
    {
        $studentId = Auth::id();

        $session = ExamSession::firstOrCreate(
            [
                'student_id' => $studentId,
                'material_id' => $material->id,
            ],
            [
                'started_at' => now(),
                'ended_at' => null,
                'is_finished' => false,
            ]
        );

        $durationSeconds = $material->duration * 60;
        $elapsedSeconds = now()->diffInSeconds($session->started_at);

        $remainingSeconds = max(0, $durationSeconds - $elapsedSeconds);

        if ($remainingSeconds === 0 && !$session->is_finished) {
            $session->update([
                'is_finished' => true,
                'ended_at' => now(),
            ]);
        }

        $existingAnswers = StudentAnswer::where('student_id', $studentId)
            ->whereIn('task_id', $material->tasks->pluck('id'))
            ->pluck('answer', 'task_id')
            ->toArray();

        return view('siswa.materials.show', [
            'material' => $material,
            'isLocked' => $session->is_finished,
            'remainingSeconds' => (int) $remainingSeconds,
            'answers' => $existingAnswers,
        ]);
    }
}