<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;

class GuruDashboardController extends Controller
{
    public function index()
    {
        // Ambil 5 siswa terbaru
        $students = User::where('role', 'siswa')
            ->orderBy('name')
            ->limit(5)
            ->get();

        // Total siswa
        $totalStudents = User::where('role', 'siswa')->count();

        $materials = Material::where('teacher_id', Auth::id())
            ->latest()
            ->take(2)
            ->get();

        return view('dashboard.guru', compact('students', 'totalStudents', 'materials'));
    }

    public function students(Request $request)
    {
        $search = $request->search;

        $students = User::where('role', 'siswa')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->get();

        return view('guru.students.index', compact('students', 'search'));
    }

}
