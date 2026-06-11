<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Classroom; // Pastikan pakai Classroom
use App\Models\Material;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class ClassController extends Controller {
    public function index() {
        $classes = Classroom::where('teacher_id', Auth::id())->get();
        return view('guru.classes.index', compact('classes'));
    }

    public function show($id) {
        $class = Classroom::with(['materials', 'students'])->findOrFail($id);
        $allStudents = User::where('role', 'siswa')->get(); 
        return view('guru.classes.show', compact('class', 'allStudents'));
    }

    public function storeMaterial(Request $request, $classId) {
        // 1. Simpan ke tabel materials
        $material = Material::create([
            'teacher_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description, // sesuai kolom di foto
            'duration' => $request->duration ?? 0
        ]);

        // 2. Hubungkan ke kelas di tabel classroom_material
        $class = Classroom::findOrFail($classId);
        $class->materials()->attach($material->id);

        return back()->with('success', 'Materi berhasil ditambahkan');
    }

    public function addStudent(Request $request, $classId) {
        $class = Classroom::findOrFail($classId);
        // Cek agar tidak duplikat
        if (!$class->students()->where('student_id', $request->student_id)->exists()) {
            $class->students()->attach($request->student_id);
        }
        return back()->with('success', 'Siswa berhasil ditambahkan');
    }
}