<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\ClassEvent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CalendarSiswaController extends Controller
{
    // Menampilkan halaman utama kalender siswa
    public function index()
    {
        return view('siswa.calendar.index');
    }

    // Mengambil data kalender yang spesifik hanya untuk kelas yang diikuti siswa tersebut
    public function getEvents()
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Ambil ID semua kelas yang diikuti siswa ini
        $classroomIds = $user->classrooms()->pluck('classrooms.id')->toArray();
        $events = [];

        if (empty($classroomIds)) {
            return response()->json([]);
        }

        // 1. Ambil data Tenggat Waktu Tugas khusus untuk kelas-kelas siswa ini
        $assignments = Assignment::whereIn('classroom_id', $classroomIds)->get();
        foreach ($assignments as $assignment) {
            $events[] = [
                'title' => '📚 Batas Tugas: ' . $assignment->title,
                'start' => $assignment->deadline->toIso8601String(),
                'color' => '#ef4444',
                'allDay' => false
            ];
        }

        // 2. Ambil data Agenda Manual dari Guru khusus untuk kelas-kelas siswa ini
        $agendaList = ClassEvent::whereIn('classroom_id', $classroomIds)->get();
        foreach ($agendaList as $agenda) {
            $events[] = [
                'title' => '📅 Agenda: ' . $agenda->title,
                'start' => $agenda->event_date->format('Y-m-d'),
                'color' => '#3b82f6',
                'allDay' => true
            ];
        }

        return response()->json($events);
    }
}