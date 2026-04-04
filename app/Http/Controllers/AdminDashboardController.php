<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Material; 

class AdminDashboardController extends Controller
{
    /**
     * Menampilkan dashboard admin dengan statistik yang sesuai dengan tabel database yang ada.
     */
    public function index()
    {
        try {
            // --- 1. Statistik Kartu (Counts) ---
            
            // Menghitung total siswa (role 'siswa')
            $totalStudents = User::where('role', 'siswa')->count();

            // Menghitung total guru (role 'guru')
            $totalTeachers = User::where('role', 'guru')->count();

            // Menghitung total pengguna selain admin
            $activeUsers = User::where('role', '!=', 'admin')->count();

            /** * PERBAIKAN DI SINI:
             * Karena error mengatakan tabel 'courses' tidak ada, kita gunakan model 'Material'.
             * Jika Anda belum punya model Material, pastikan membuatnya dengan: php artisan make:model Material
             */
            $totalMaterials = Material::count(); 
            
            // --- 2. Data untuk Tabel/List Terbaru ---
            
            // Mengambil 4 pengguna terbaru
            $users = User::where('role', '!=', 'admin')->latest()->limit(4)->get(); 
            $recentUsers = $users; 

            // Mengambil 4 materi terbaru sebagai pengganti course
            $recentMaterials = Material::latest()->limit(4)->get();
            
            
            // --- 3. Mengirim Data ke View ---

            return view('dashboard.admin', compact(
                'totalStudents',
                'totalTeachers',
                'activeUsers',
                'totalMaterials', // Nama variabel disesuaikan
                'users',
                'recentUsers',
                'recentMaterials'
            ));

        } catch (\Exception $e) {
            throw $e;
        }
    }
}