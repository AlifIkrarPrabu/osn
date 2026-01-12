<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskAnswerController extends Controller
{
    public function store(Request $request)
    {
        $taskIds = collect($request->tasks)->pluck('task_id');

        $alreadySubmitted = StudentAnswer::where('student_id', Auth::id())
            ->whereIn('task_id', $taskIds)
            ->exists();

        if ($alreadySubmitted) {
            return back()->with('error', 'Jawaban sudah dikirim dan terkunci.');
        }

        foreach ($request->tasks as $taskData) {
            StudentAnswer::create([
                'student_id' => Auth::id(),
                'task_id'    => $taskData['task_id'],
                'answer'     => $taskData['answer'],
            ]);
        }

        return back()->with('success', 'Jawaban berhasil dikirim!');
    }
}