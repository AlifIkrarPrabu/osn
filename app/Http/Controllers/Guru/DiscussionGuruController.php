<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\DiscussionTopic;
use App\Models\DiscussionReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionGuruController extends Controller
{
    // Menampilkan halaman utama diskusi (Pilih kelas & Daftar Topik)
    public function index(Request $request)
    {
        $teacherId = Auth::id();
        
        // Ambil semua kelas milik guru ini
        $classrooms = Classroom::where('teacher_id', $teacherId)->get();
        $selectedClassId = $request->query('class_id');
        
        $topics = collect();
        if ($selectedClassId) {
            $topics = DiscussionTopic::where('classroom_id', $selectedClassId)
                ->with(['user', 'replies'])
                ->latest()
                ->get();
        }

        return view('guru.discussions.index', compact('classrooms', 'topics', 'selectedClassId'));
    }

    // Menyimpan topik diskusi baru yang dibuat oleh Guru
    public function storeTopic(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        DiscussionTopic::create([
            'classroom_id' => $request->classroom_id,
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Topik diskusi baru berhasil diterbitkan!');
    }

    // Melihat detail sebuah topik beserta seluruh komentar di dalamnya
    public function show($id)
    {
        $topic = DiscussionTopic::with(['user', 'classroom', 'replies.user'])->findOrFail($id);
        return view('guru.discussions.show', compact('topic'));
    }

    // Menyimpan balasan komentar dari Guru
    public function storeReply(Request $request, $topicId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        DiscussionReply::create([
            'discussion_topic_id' => $topicId,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil dikirim!');
    }

    // Menghapus topik diskusi (Fitur Moderasi Guru)
    public function destroyTopic($id)
    {
        $topic = DiscussionTopic::findOrFail($id);
        $topic->delete();
        return redirect()->route('guru.discussions.index', ['class_id' => $topic->classroom_id])->with('success', 'Topik diskusi berhasil dihapus!');
    }
}