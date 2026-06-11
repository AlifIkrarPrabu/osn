<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller {
    public function index() {
        $classes = Classroom::where('teacher_id', Auth::id())->withCount('materials')->get();
        return view('guru.classes.index', compact('classes'));
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required']);
        Classroom::create([
            'name' => $request->name,
            'teacher_id' => Auth::id()
        ]);
        return back()->with('success', 'Kelas berhasil dibuat');
    }

    // Fungsi untuk mengelola materi di dalam kelas
    public function manageMaterials($id) {
        $class = Classroom::findOrFail($id);
        // Ambil semua materi milik guru ini
        $allMaterials = Material::where('teacher_id', Auth::id())->get();
        // ID materi yang sudah ada di kelas ini
        $selectedMaterials = $class->materials->pluck('id')->toArray();

        return view('guru.classes.manage', compact('class', 'allMaterials', 'selectedMaterials'));
    }

    public function updateMaterials(Request $request, $id) {
        $class = Classroom::findOrFail($id);
        // Sync akan menghapus yang lama dan menambah yang baru berdasarkan checkbox
        $class->materials()->sync($request->materials);
        
        return redirect()->route('guru.classes.index')->with('success', 'Materi kelas diperbarui');
    }

    public function destroy($id) {
        Classroom::findOrFail($id)->delete();
        return back()->with('success', 'Kelas dihapus');
    }
}