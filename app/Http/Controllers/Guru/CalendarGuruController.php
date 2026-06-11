<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Assignment;
use App\Models\ClassEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarGuruController extends Controller
{
    // Menampilkan halaman utama kalender guru
    public function index()
    {
        // Ambil semua kelas milik guru ini untuk opsi dropdown form agenda
        $classrooms = Classroom::where('teacher_id', Auth::id())->get();
        return view('guru.calendar.index', compact('classrooms'));
    }

    // Mengambil data gabungan (Tugas + Agenda) dalam format JSON untuk FullCalendar
    public function getEvents()
    {
        $teacherId = Auth::id();
        $events = [];

        // 1. Ambil data Tenggat Waktu Tugas (Assignments) milik Guru ini
        $assignments = Assignment::where('teacher_id', $teacherId)->with('classroom')->get();
        foreach ($assignments as $assignment) {
            $events[] = [
                'id' => 'task_' . $assignment->id,
                'title' => '📚 [' . $assignment->classroom->name . '] ' . $assignment->title,
                'start' => $assignment->deadline->toIso8601String(),
                'color' => '#ef4444', // Warna Merah untuk penanda Tugas/Deadline
                'allDay' => false
            ];
        }

        // 2. Ambil data Agenda Manual (Class Events) yang dibuat oleh Guru ini
        $agendaList = ClassEvent::where('user_id', $teacherId)->with('classroom')->get();
        foreach ($agendaList as $agenda) {
            $events[] = [
                'id' => 'event_' . $agenda->id,
                'title' => '📅 [' . $agenda->classroom->name . '] ' . $agenda->title,
                'start' => $agenda->event_date->format('Y-m-d'),
                'color' => '#3b82f6', // Warna Biru untuk agenda manual guru
                'allDay' => true,
                'extendedProps' => [
                    'isManualEvent' => true // Penanda bahwa ini bisa dihapus
                ]
            ];
        }

        return response()->json($events);
    }

    // Menyimpan agenda kelas manual baru yang diinput guru
    public function storeEvent(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
        ]);

        ClassEvent::create([
            'classroom_id' => $request->classroom_id,
            'user_id' => Auth::id(),
            'title' => $request->title,
            'event_date' => $request->event_date,
        ]);

        return redirect()->back()->with('success', 'Agenda kelas baru berhasil dijadwalkan!');
    }

    // MENAMBAHKAN TIPE DATA string|int PADA PARAMETER $id
    public function destroyEvent(string|int $id)
    {
        $agenda = ClassEvent::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $agenda->delete();

        return response()->json(['success' => true, 'message' => 'Agenda berhasil dihapus!']);
    }
}