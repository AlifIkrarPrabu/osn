<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\DiscussionTopic;
use App\Models\DiscussionReply;
use App\Models\User; // Ditambahkan untuk memberi tahu VS Code
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionSiswaController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Mengambil kelas pertama tempat siswa terdaftar
        $classroom = $user->classrooms()->first();

        if (!$classroom) {
            return view('siswa.discussions.index', ['topics' => collect(), 'classroom' => null]);
        }

        $topics = DiscussionTopic::where('classroom_id', $classroom->id)
            ->with(['user', 'replies'])
            ->latest()
            ->get();

        return view('siswa.discussions.index', compact('topics', 'classroom'));
    }

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

        return redirect()->back()->with('success', 'Topik diskusi berhasil dikirim ke forum kelas!');
    }

    // Menambahkan tipe data string/int pada $id untuk menghilangkan info biru
    public function show(string|int $id)
    {
        $topic = DiscussionTopic::with(['user', 'classroom', 'replies.user'])->findOrFail($id);
        return view('siswa.discussions.show', compact('topic'));
    }

    // Menambahkan tipe data Request dan string/int pada $topicId untuk menghilangkan info biru
    public function storeReply(Request $request, string|int $topicId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        DiscussionReply::create([
            'discussion_topic_id' => $topicId,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Komentar Anda berhasil dikirim!');
    }
}