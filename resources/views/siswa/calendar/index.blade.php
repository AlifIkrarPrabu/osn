@extends('layouts.app', ['title' => 'Kalender Akademik'])

@section('content')
<div class="lg:hidden p-4">
    <button id="hamburgerBtn" class="p-2 border rounded-lg">☰</button>
</div>

<div class="flex">
    @include('partials.sidebar-siswa')
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden"></div>

    <div class="flex-1 p-6 max-w-6xl">
        <h1 class="text-3xl font-bold mb-2">📅 Agenda Belajar Saya</h1>
        <p class="text-gray-500 mb-6 font-semibold">Pantau jadwal ujian dari guru dan batas waktu pengumpulan tugas kelas Anda.</p>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <div class="bg-white border rounded-xl p-5 shadow-sm h-fit">
                <h2 class="font-bold text-gray-800 mb-3 text-sm">Petunjuk Kalender:</h2>
                <div class="space-y-3 text-xs text-gray-600">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-red-500 rounded shrink-0"></span>
                        <span>🔴 <strong>Batas Tugas:</strong> Kumpulkan jawaban sebelum tanggal ini agar tidak terlambat.</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-blue-500 rounded shrink-0"></span>
                        <span>🔵 <strong>Agenda Kelas:</strong> Jadwal penting (Ujian, Zoom, atau info dari Guru).</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="bg-white border rounded-xl p-6 shadow-sm">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek'
        },
        locale: 'id',
        editable: false,
        events: "{{ route('siswa.calendar.events') }}" // Mengambil data JSON spesifik siswa
    });
    
    calendar.render();
});

// Script Hamburger Responsive Layout Siswa
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');
const btn = document.getElementById('hamburgerBtn');

btn?.addEventListener('click', () => {
    sidebar.classList.remove('-translate-x-full');
    overlay.classList.remove('hidden');
});

overlay?.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
});
</script>

<style>
    .fc .fc-toolbar-title { font-size: 1.25rem !important; font-weight: 700; color: #1f2937; }
    .fc .fc-button-primary { background-color: #3b82f6 !important; border-color: #3b82f6 !important; font-weight: 600; font-size: 0.875rem; text-transform: capitalize; }
    .fc .fc-button-primary:hover { background-color: #2563eb !important; }
    .fc .fc-button-active { background-color: #1d4ed8 !important; }
    .fc-event { padding: 2px 4px; border-radius: 4px; font-size: 11px !important; font-weight: 500; }
</style>
@endsection