<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AnnouncementSiswaController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Ambil kelas pertama tempat siswa ini terdaftar
        $classroom = $user->classrooms()->first();

        if (!$classroom) {
            return view('siswa.announcements.index', ['announcements' => collect(), 'classroom' => null]);
        }

        // Ambil semua pengumuman khusus untuk kelas siswa ini
        $announcements = Announcement::where('classroom_id', $classroom->id)
            ->with('user')
            ->latest()
            ->get();

        return view('siswa.announcements.index', compact('announcements', 'classroom'));
    }
}