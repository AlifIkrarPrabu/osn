<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\StudentAnswer; // ✅ INI YANG BENAR
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function show(Material $material)
    {
        $material->load('tasks');

        // 🔒 CEK APAKAH SUDAH PERNAH JAWAB
        $isLocked = StudentAnswer::where('student_id', Auth::id())
            ->whereIn('task_id', $material->tasks->pluck('id'))
            ->exists();

        return view('siswa.materials.show', compact('material', 'isLocked'));
    }
}
