<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;

class GradeSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $classIds = $user->classrooms->pluck('id');

        // Ambil semua tugas di kelas siswa yang sudah memiliki nilai (submission)
        $assignments = Assignment::whereIn('classroom_id', $classIds)
            ->whereHas('submissions', function($q) {
                $q->where('student_id', Auth::id());
            })
            ->with(['submissions' => function($q) {
                $q->where('student_id', Auth::id());
            }])
            ->get();

        // Hitung rata-rata nilai siswa jika ada tugas yang selesai
        $totalScore = 0;
        $completedCount = $assignments->count();

        foreach ($assignments as $assignment) {
            $totalScore += $assignment->submissions->first()->score ?? 0;
        }

        $averageScore = $completedCount > 0 ? round($totalScore / $completedCount) : 0;

        return view('siswa.grades.index', compact('assignments', 'averageScore', 'completedCount'));
    }
}