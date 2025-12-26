<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua materi (tanpa kelas, sesuai kebutuhan Anda)
        $materials = Material::latest()->take(5)->get();

        return view('dashboard.siswa', [
            'materials' => $materials
        ]);
    }
}
