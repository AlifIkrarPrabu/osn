<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\ExamSession;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function store(Request $request, Material $material)
    {
        $studentId = Auth::id();

        // Ambil session ujian
        $session = ExamSession::where('student_id', $studentId)
            ->where('material_id', $material->id)
            ->firstOrFail();

        // ⛔ Jika sudah selesai
        if ($session->is_finished) {
            return back()->with('error', 'Ujian sudah selesai.');
        }

        foreach ($request->answers ?? [] as $taskId => $answer) {
            StudentAnswer::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'task_id' => $taskId,
                ],
                [
                    'answer' => $answer,
                ]
            );
        }

        // 🔒 Kunci ujian
        $session->update([
            'is_finished' => true,
            'end_time' => now(),
        ]);

        return redirect()
            ->route('siswa.materials.show', $material->id)
            ->with('success', 'Jawaban berhasil disimpan.');
    }
}
