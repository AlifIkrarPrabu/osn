<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data siswa yang sedang login beserta kelasnya
        $user = Auth::user();
        
        // Ambil semua kelas yang diikuti siswa ini
        $myClasses = $user->classrooms;

        // Ambil materi terbaru secara umum (opsional, bisa tetap ada)
        $materials = Material::latest()->paginate(3);

        return view('dashboard.siswa', compact('myClasses', 'materials'));
    }
}