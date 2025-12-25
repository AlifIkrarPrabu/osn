<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Material;

class MaterialController extends Controller
{
    public function show(Material $material)
    {
        $material->load('tasks');

        return view('siswa.materials.show', compact('material'));
    }
}
