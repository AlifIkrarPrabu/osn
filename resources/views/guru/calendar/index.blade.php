@extends('layouts.app', ['title' => 'Kalender Akademik'])

@section('content')
{{-- =========================== --}}
{{-- HAMBURGER (MOBILE ONLY) --}}
{{-- =========================== --}}
<div class="lg:hidden p-4">
    <button id="hamburgerBtn" class="p-2 border rounded-lg">
        ☰
    </button>
</div>

{{-- =========================== --}}
{{-- WRAPPER --}}
{{-- =========================== --}}
<div class="flex">

    {{-- =========================== --}}
    {{-- SIDEBAR --}}
    {{-- =========================== --}}
    @include('partials.sidebar-guru')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-2">📅 Kalender Akademik</h1>
    <p class="text-gray-500 mb-6 font-semibold">Pantau tenggat waktu tugas dan jadwalkan agenda penting kelas.</p>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4 max-w-6xl">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 max-w-6xl">
        <div>
            <div class="bg-white border rounded-xl p-5 shadow-sm sticky top-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Tambah Agenda Kelas</h2>
                <form action="{{ route('guru.calendar.store_event') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Kelas</label>
                        <select name="classroom_id" required class="w-full border rounded-lg px-3 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($classrooms as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Agenda</label>
                        <input type="text" name="title" required placeholder="Contoh: Ulangan Harian Bab 3" class="w-full border rounded-lg px-3 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pelaksanaan</label>
                        <input type="date" name="event_date" required class="w-full border rounded-lg px-3 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition text-sm">Jadwalkan Agenda</button>
                </form>

                <div class="mt-6 pt-4 border-t text-xs text-gray-500 space-y-2">
                    <p class="font-semibold text-gray-700">Keterangan Warna:</p>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-red-500 rounded"></span> <span>Batas Pengumpulan Tugas (Otomatis)</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-blue-500 rounded"></span> <span>Agenda Kelas Manual (Guru)</span>
                    </div>
                    <p class="italic text-[11px] pt-2 text-gray-400">*Tips: Anda bisa mengklik agenda berwarna biru pada kalender untuk menghapusnya.</p>
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
        locale: 'id', // Set bahasa ke Indonesia (opsional, bawaan mengikuti browser)
        editable: false,
        events: "{{ route('guru.calendar.events') }}", // Mengambil data JSON dari controller
        
        // Aksi ketika agenda diklik (Khusus Agenda Manual untuk Fitur Hapus)
        eventClick: function(info) {
            if (info.event.extendedProps.isManualEvent) {
                if (confirm("Apakah Anda ingin menghapus agenda '" + info.event.title + "' dari kalender?")) {
                    // Ambil ID murni agenda (menghilangkan prefix 'event_')
                    const eventId = info.event.id.replace('event_', '');
                    
                    fetch("/guru/calendar/event/" + eventId, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            info.event.remove(); // Hapus instan dari layar kalender
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            } else {
                alert("Ini adalah batas pengumpulan tugas otomatis. Informasi detail dapat dilihat pada menu 'Assignments'.");
            }
        }
    });
    
    calendar.render();
});
</script>

<style>
    .fc .fc-toolbar-title { font-size: 1.25rem !important; font-weight: 700; color: #1f2937; }
    .fc .fc-button-primary { background-color: #3b82f6 !important; border-color: #3b82f6 !important; font-weight: 600; font-size: 0.875rem; text-transform: capitalize; }
    .fc .fc-button-primary:hover { background-color: #2563eb !important; }
    .fc .fc-button-active { background-color: #1d4ed8 !important; }
    .fc-event { cursor: pointer; padding: 2px 4px; border-radius: 4px; font-size: 11px !important; font-weight: 500; }
</style>
@endsection