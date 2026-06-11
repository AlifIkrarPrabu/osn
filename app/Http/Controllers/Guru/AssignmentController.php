<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::where('teacher_id', Auth::id())
            ->with('classroom')
            ->latest()
            ->get();

        return view('guru.assignments.index', compact('assignments'));
    }

    public function create()
    {
        $classrooms = Classroom::where('teacher_id', Auth::id())->get();
        return view('guru.assignments.create', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'classroom_id' => 'required|exists:classrooms,id',
            'deadline' => 'required|date|after:now',
            'questions' => 'required|array|min:1',
            'questions.*.text' => 'required|string',
            'questions.*.a' => 'required|string',
            'questions.*.b' => 'required|string',
            'questions.*.c' => 'required|string',
            'questions.*.d' => 'required|string',
            'questions.*.correct' => 'required|in:a,b,c,d',
        ]);

        $assignment = Assignment::create([
            'title' => $request->title,
            'description' => $request->description,
            'classroom_id' => $request->classroom_id,
            'teacher_id' => Auth::id(),
            'deadline' => $request->deadline,
        ]);

        foreach ($request->questions as $q) {
            $assignment->questions()->create([
                'question_text' => $q['text'],
                'option_a' => $q['a'],
                'option_b' => $q['b'],
                'option_c' => $q['c'],
                'option_d' => $q['d'],
                'correct_answer' => $q['correct'],
            ]);
        }

        return redirect()->route('guru.assignments.index')->with('success', 'Tugas Berhasil Diterbitkan!');
    }

    // --- FITUR EDIT ---
    public function edit(Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::id()) { abort(403); }
        
        $classrooms = Classroom::where('teacher_id', Auth::id())->get();
        // Mengambil tugas beserta soal-soalnya
        $assignment->load('questions'); 
        
        return view('guru.assignments.edit', compact('assignment', 'classrooms'));
    }

    // --- FITUR UPDATE ---
    public function update(Request $request, Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::id()) { abort(403); }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'classroom_id' => 'required|exists:classrooms,id',
            'deadline' => 'required|date',
            'questions' => 'required|array|min:1',
        ]);

        // Update Data Utama
        $assignment->update([
            'title' => $request->title,
            'description' => $request->description,
            'classroom_id' => $request->classroom_id,
            'deadline' => $request->deadline,
        ]);

        // Update Soal: Hapus soal lama, masukkan yang baru (cara paling aman agar tidak tertukar)
        $assignment->questions()->delete();
        foreach ($request->questions as $q) {
            $assignment->questions()->create([
                'question_text' => $q['text'],
                'option_a' => $q['a'],
                'option_b' => $q['b'],
                'option_c' => $q['c'],
                'option_d' => $q['d'],
                'correct_answer' => $q['correct'],
            ]);
        }

        return redirect()->route('guru.assignments.index')->with('success', 'Tugas Berhasil Diperbarui!');
    }

    // --- FITUR HAPUS ---
    public function destroy(Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::id()) { abort(403); }
        
        $assignment->delete(); // Otomatis menghapus soal karena Cascade di database
        return redirect()->route('guru.assignments.index')->with('success', 'Tugas Berhasil Dihapus!');
    }

    public function show(Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::id()) { abort(403); }

        $students = $assignment->classroom->students()
            ->with(['submissions' => function($query) use ($assignment) {
                $query->where('assignment_id', $assignment->id);
            }])->get();

        return view('guru.assignments.show', compact('assignment', 'students'));
    }

    public function grade(Request $request, Submission $submission)
    {
        $request->validate([
            'score' => 'required|integer|min:0|max:100',
            'teacher_notes' => 'nullable|string',
        ]);

        $submission->update([
            'score' => $request->score,
            'teacher_notes' => $request->teacher_notes,
        ]);

        return back()->with('success', 'Nilai berhasil disimpan!');
    }
}