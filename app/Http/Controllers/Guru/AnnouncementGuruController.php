<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementGuruController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kelas yang diajar oleh guru ini
        $classrooms = Classroom::where('teacher_id', Auth::id())->get();
        $selectedClassId = $request->query('class_id');

        $announcements = collect();
        if ($selectedClassId) {
            $announcements = Announcement::where('classroom_id', $selectedClassId)
                ->with('user')
                ->latest()
                ->get();
        }

        return view('guru.announcements.index', compact('classrooms', 'announcements', 'selectedClassId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Announcement::create([
            'classroom_id' => $request->classroom_id,
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Pengumuman kelas baru berhasil diterbitkan!');
    }

    public function destroy(string|int $id)
    {
        $announcement = Announcement::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $announcement->delete();

        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus!');
    }
}