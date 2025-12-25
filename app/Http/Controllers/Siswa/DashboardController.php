<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Material;

class DashboardController extends Controller
{
    public function index()
    {
        $materials = Material::latest()->get();

        return view('dashboard.siswa', compact('materials'));
    }
}
