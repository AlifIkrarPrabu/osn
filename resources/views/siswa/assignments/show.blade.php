@extends('layouts.app', ['title' => 'Mengerjakan Tugas'])

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
        {{-- Pembatas lebar konten agar soal tidak terlalu melar ke samping dan nyaman dibaca --}}
        <div class="max-w-3xl mx-auto">
            
            <div class="mb-8">
                <a href="{{ route('siswa.assignments.index') }}" class="text-sm font-semibold text-blue-600 hover:underline">← Kembali ke Daftar Tugas</a>
                <h1 class="text-3xl font-bold mt-2">{{ $assignment->title }}</h1>
                <p class="text-gray-600 mt-1">{{ $assignment->description }}</p>
            </div>

            <form action="{{ route('siswa.assignments.submit', $assignment->id) }}" method="POST">
                @csrf
                <div class="space-y-8">
                    @foreach($assignment->questions as $index => $question)
                        <div class="bg-white border rounded-xl p-6 shadow-sm">
                            <p class="font-bold text-lg mb-4">{{ $index + 1 }}. {{ $question->question_text }}</p>
                            
                            <div class="space-y-3">
                                @foreach(['a', 'b', 'c', 'd'] as $opt)
                                    <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-blue-50 transition">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $opt }}" required class="w-4 h-4 text-blue-600">
                                        <span class="text-gray-700">
                                            <strong>{{ strtoupper($opt) }}.</strong> {{ $question->{'option_'.$opt} }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10 mb-20">
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengirim jawaban?')" class="w-full bg-green-600 text-white font-bold py-4 rounded-xl shadow-lg hover:bg-green-700 transition text-lg">
                        Kirim Jawaban Tugas
                    </button>
                </div>
            </form>

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