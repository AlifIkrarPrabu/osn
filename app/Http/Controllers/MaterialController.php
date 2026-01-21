<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    // ================================
    // LIST MATERIAL
    // ================================
    public function index()
    {
        $materials = Material::where('teacher_id', Auth::id())->get();

        return view('guru.materials.index', compact('materials'));
    }

    // ================================
    // CREATE MATERIAL
    // ================================
    public function create()
    {
        return view('guru.materials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'duration' => 'required|integer|min:1', // ⬅️ VALIDASI WAKTU
        ]);

        Material::create([
            'teacher_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration, // ⬅️ SIMPAN WAKTU UJIAN
        ]);

        return redirect()->route('guru.materials.index')
            ->with('success', 'Materi berhasil ditambahkan');
    }

    // ================================
    // EDIT MATERIAL
    // ================================
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable'
        ]);

        $material = Material::where('teacher_id', Auth::id())->findOrFail($id);

        $material->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Materi berhasil diperbarui'
        ]);
    }



    // ================================
    // HAPUS MATERIAL
    // ================================
    public function destroy($id)
    {
        $material = Material::where('teacher_id', Auth::id())->findOrFail($id);
        $material->delete();

        return redirect()->route('guru.materials.index')
            ->with('success', 'Materi berhasil dihapus');
    }

    // ================================
    // SHOW MATERIAL + TASKS
    // ================================
    public function show($id)
    {
        $material = Material::with('tasks')
            ->where('teacher_id', Auth::id())  // keamanan: hanya pemilik bisa akses
            ->findOrFail($id);

        return view('guru.materials.show', compact('material'));
    }

    // ================================
    // ADD TASK
    // ================================
    public function storeTask(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'question' => 'required',
        ]);

        Task::create([
            'material_id' => $id,
            'type' => $request->type,
            'question' => $request->question,
            'option_a' => $request->option_a ?? null,
            'option_b' => $request->option_b ?? null,
            'option_c' => $request->option_c ?? null,
            'option_d' => $request->option_d ?? null,
            'correct_answer' => $request->correct_answer ?? null,
        ]);

        return back()->with('success', 'Tugas berhasil ditambahkan');
    }
    
    // ================================
    // UPDATE TASK (AJAX)
    // ================================
    public function updateTask(Request $request, $taskId)
    {
        $request->validate([
            'type' => 'required',
            'question' => 'required',
        ]);

        $task = Task::findOrFail($taskId);

        // keamanan → pastikan guru pemilik material
        if ($task->material->teacher_id !== Auth::id()) {
            abort(403);
        }

        $task->update([
            'type' => $request->type,
            'question' => $request->question,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'correct_answer' => $request->correct_answer,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tugas berhasil diperbarui'
        ]);
    }



    // ================================
    // DELETE TASK (AJAX)
    // ================================
    public function deleteTask($taskId)
    {
        $task = Task::findOrFail($taskId);

        if ($task->material->teacher_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tugas berhasil dihapus'
        ]);
    }

}
