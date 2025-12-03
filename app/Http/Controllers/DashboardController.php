<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Mengarahkan pengguna ke dashboard yang sesuai berdasarkan peran (role).
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectBasedOnRole()
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            // Atau redirect ke login jika belum terautentikasi
            return redirect()->route('login'); 
        }

        $user = Auth::user();

        // Cek peran menggunakan helper method dari Model User
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isGuru()) {
            return redirect()->route('guru.dashboard');
        } else {
            // Default: Siswa (jika isSiswa() atau peran lainnya)
            return redirect()->route('siswa.dashboard');
        }
    }
}