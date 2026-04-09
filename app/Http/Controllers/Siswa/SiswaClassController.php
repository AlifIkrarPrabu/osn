<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SiswaClassController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Mengambil kelas yang diikuti siswa
        $myClasses = $user->classrooms;

        return view('siswa.classes.index', compact('myClasses'));
    }
}