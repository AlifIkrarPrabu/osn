<?php

namespace App\Http\Controllers;

use App\Models\User;

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

        return view('dashboard.guru', compact('students', 'totalStudents'));
    }
}
