@extends('layouts.app', ['title' => 'Daftar Tugas'])

@section('content')

{{-- Tombol Hamburger untuk tampilan Mobile/HP --}}
<div class="lg:hidden p-4">
    <button id="hamburgerBtn" class="p-2 border rounded-lg">☰</button>
</div>

<div class="flex">

    {{-- 1. MEMANGGIL SIDEBAR --}}
    @include('partials.sidebar-siswa')

    {{-- OVERLAY untuk tampilan Mobile/HP --}}
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden"></div>

    {{-- 2. PEMBUNGKUS KONTEN UTAMA --}}
    <div class="flex-1 p-6">
        
        <h1 class="text-3xl font-bold mb-6">Tugas Saya</h1>

        {{-- Notifikasi Sukses / Gagal --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">{{ session('error') }}</div>
        @endif

        {{-- Grid Kartu Tugas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($assignments as $assignment)
                @php $submission = $assignment->submissions->first(); @endphp
                <div class="bg-white border rounded-xl p-5 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-2">
                            <h2 class="text-xl font-bold">{{ $assignment->title }}</h2>
                            @if($submission)
                                <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">Selesai</span>
                            @else
                                <span class="bg-yellow-100 text-yellow-600 text-xs px-2 py-1 rounded-full">Belum</span>
                            @endif
                        </div>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $assignment->description }}</p>
                        <p class="text-xs text-gray-400 font-medium italic">Deadline: {{ $assignment->deadline->format('d M Y, H:i') }}</p>
                    </div>

                    <div class="mt-6 border-t pt-4">
                        @if($submission)
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-bold">Nilai: <span class="text-blue-600 text-lg">{{ $submission->score }}</span></span>
                                <span class="text-xs text-gray-400 italic">Selesai pada: {{ $submission->submitted_at->format('d/m/y') }}</span>
                            </div>
                        @else
                            <a href="{{ route('siswa.assignments.show', $assignment->id) }}" class="block w-full text-center bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition">
                                Kerjakan Sekarang
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 border-2 border-dashed rounded-xl">
                    <p class="text-gray-500 italic">Tidak ada tugas untuk saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

{{-- Script Javascript agar tombol Hamburger di HP bisa berfungsi --}}
<script>
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

@endsection