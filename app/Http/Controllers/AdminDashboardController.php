<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Course; 

class AdminDashboardController extends Controller
{
    /**
     * Menampilkan dashboard admin dengan semua statistik yang diperlukan.
     */
    public function index()
    {
        try {
            // --- 1. Statistik Kartu (Counts) ---
            
            // Menghitung total siswa (role 'siswa')
            $totalStudents = User::where('role', 'siswa')->count();

            // Menghitung total guru (role 'guru')
            $totalTeachers = User::where('role', 'guru')->count();

            // Menghitung total pengguna aktif (Asumsi: semua yang bukan 'admin')
            // Berdasarkan query Anda, ini bisa jadi 'users' secara keseluruhan,
            // atau hanya 'siswa' + 'guru'. Saya akan menggunakan semua pengguna - admin
            $activeUsers = User::where('role', '!=', 'admin')->count();

            // Menghitung total Course/Mata Pelajaran (Asumsi: semua course aktif)
            $totalCourses = Course::count();
            
            // --- 2. Data untuk Tabel/List Terbaru ---
            
            // Mengambil 4 pengguna terbaru untuk 'User Management'
            // Gunakan $users untuk kompatibilitas dengan view yang error
            $users = User::latest()->limit(4)->get(); 
            $recentUsers = $users; // Alias jika Anda ingin nama yang lebih spesifik

            // Mengambil 4 course terbaru untuk 'Course Management'
            $recentCourses = Course::latest()->limit(4)->get();
            
            
            // --- 3. Mengirim Data ke View ---

            // Menggunakan compact() untuk mengirim semua variabel ke view
            return view('dashboard.admin', compact(
                'totalStudents',
                'totalTeachers',
                'activeUsers', // Jika Anda menggunakan Active Users
                'totalCourses',
                'users',         // <--- INI PERBAIKAN UTAMA untuk menghilangkan error "Undefined variable $users"
                'recentUsers',   // Tetap disertakan jika Anda menggunakannya
                'recentCourses'
            ));

        } catch (\Exception $e) {
            // Opsional: Log error untuk debugging lebih lanjut
            // Log::error("Error loading admin dashboard: " . $e->getMessage()); 
            
            // Jika ada error (misalnya koneksi DB atau model tidak ditemukan), 
            // Anda bisa mengarahkan ke halaman error atau kembali dengan pesan
            // Untuk sementara, kita throw error agar Anda bisa melihat masalahnya.
            throw $e;
        }
    }
}