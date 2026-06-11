<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentSiswaController extends Controller
{
    // Menampilkan daftar tugas untuk kelas yang diikuti siswa
    public function index()
    {
        $user = Auth::user();
        $classIds = $user->classrooms->pluck('id');

        // Ambil tugas yang ada di kelas siswa, beserta status kumpulnya
        $assignments = Assignment::whereIn('classroom_id', $classIds)
            ->with(['submissions' => function($q) {
                $q->where('student_id', Auth::id());
            }])
            ->latest()
            ->get();

        return view('siswa.assignments.index', compact('assignments'));
    }

    // Menampilkan halaman pengerjaan soal
    public function show(Assignment $assignment)
    {
        // Cek apakah siswa sudah pernah mengerjakan
        $alreadySubmitted = Submission::where('assignment_id', $assignment->id)
            ->where('student_id', Auth::id())
            ->first();

        if ($alreadySubmitted) {
            return redirect()->route('siswa.assignments.index')->with('error', 'Anda sudah mengerjakan tugas ini!');
        }

        return view('siswa.assignments.show', compact('assignment'));
    }

    // Proses simpan jawaban dan hitung nilai otomatis
    public function store(Request $request, Assignment $assignment)
    {
        $request->validate([
            'answers' => 'required|array',
        ]);

        $totalQuestions = $assignment->questions->count();
        $correctCount = 0;

        // Logika Hitung Nilai Otomatis
        foreach ($assignment->questions as $question) {
            $studentAnswer = $request->answers[$question->id] ?? null;
            if ($studentAnswer == $question->correct_answer) {
                $correctCount++;
            }
        }

        // Rumus Nilai: (Benar / Total Soal) * 100
        $score = ($totalQuestions > 0) ? round(($correctCount / $totalQuestions) * 100) : 0;

        Submission::create([
            'assignment_id' => $assignment->id,
            'student_id' => Auth::id(),
            'content' => json_encode($request->answers), // Simpan semua jawaban siswa
            'score' => $score,
            'submitted_at' => now(),
            'teacher_notes' => 'Nilai otomatis oleh sistem.',
        ]);

        return redirect()->route('siswa.assignments.index')->with('success', "Tugas berhasil dikirim! Nilai Anda: $score");
    }
}