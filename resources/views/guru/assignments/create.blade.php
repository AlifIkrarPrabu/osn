@extends('layouts.app', ['title' => 'Buat Tugas'])

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

    {{-- =========================== --}}
    {{-- OVERLAY (MOBILE ONLY) --}}
    {{-- =========================== --}}
    <div id="overlay"
        class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden">
    </div>
<div class="p-6 max-w-4xl">
    <div class="mb-6">
        <a href="{{ route('guru.assignments.index') }}" class="text-blue-600 hover:underline">← Kembali ke Daftar</a>
        <h1 class="text-3xl font-bold text-gray-800 mt-2">Buat Tugas Baru</h1>
    </div>

    <div class="bg-white border rounded-xl shadow-sm p-6">
        <form action="{{ route('guru.assignments.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                {{-- Judul --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Tugas</label>
                    <input type="text" name="title" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Contoh: Tugas Praktikum Jaringan" required>
                </div>

                {{-- Pilih Kelas --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Target Kelas</label>
                    <select name="classroom_id" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($classrooms as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Instruksi Tugas</label>
                    <textarea name="description" rows="5" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Tuliskan instruksi lengkap untuk siswa di sini..." required></textarea>
                </div>

                {{-- Deadline --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Batas Waktu (Deadline)</label>
                    <input type="datetime-local" name="deadline" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
                <div class="mt-8 border-t pt-6">
                {{-- Pilihan Ganda --}}    
                    <h2 class="text-xl font-bold mb-4">Daftar Soal Pilihan Ganda</h2>
                    <div id="question-container" class="space-y-6">
                        <div class="p-4 border rounded-lg bg-gray-50 question-item">
                            <div class="mb-3">
                                <label class="block text-sm font-bold">Pertanyaan 1</label>
                                <input type="text" name="questions[0][text]" class="w-full border rounded px-3 py-2" required>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" name="questions[0][a]" placeholder="Pilihan A" class="border rounded px-3 py-1" required>
                                <input type="text" name="questions[0][b]" placeholder="Pilihan B" class="border rounded px-3 py-1" required>
                                <input type="text" name="questions[0][c]" placeholder="Pilihan C" class="border rounded px-3 py-1" required>
                                <input type="text" name="questions[0][d]" placeholder="Pilihan D" class="border rounded px-3 py-1" required>
                            </div>
                            <div class="mt-2">
                                <label class="text-sm font-semibold text-green-700">Jawaban Benar:</label>
                                <select name="questions[0][correct]" class="border rounded ml-2">
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                    <option value="c">C</option>
                                    <option value="d">D</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="add-question" class="mt-4 text-blue-600 font-bold hover:underline">
                        + Tambah Soal Lagi
                    </button>
                </div>

                <script>
                    let questionCount = 1;
                    document.getElementById('add-question').addEventListener('click', function() {
                        let container = document.getElementById('question-container');
                        let html = `
                            <div class="p-4 border rounded-lg bg-gray-50 question-item">
                                <div class="mb-3">
                                    <label class="block text-sm font-bold">Pertanyaan ${questionCount + 1}</label>
                                    <input type="text" name="questions[${questionCount}][text]" class="w-full border rounded px-3 py-2" required>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <input type="text" name="questions[${questionCount}][a]" placeholder="Pilihan A" class="border rounded px-3 py-1" required>
                                    <input type="text" name="questions[${questionCount}][b]" placeholder="Pilihan B" class="border rounded px-3 py-1" required>
                                    <input type="text" name="questions[${questionCount}][c]" placeholder="Pilihan C" class="border rounded px-3 py-1" required>
                                    <input type="text" name="questions[${questionCount}][d]" placeholder="Pilihan D" class="border rounded px-3 py-1" required>
                                </div>
                                <div class="mt-2">
                                    <label class="text-sm font-semibold text-green-700">Jawaban Benar:</label>
                                    <select name="questions[${questionCount}][correct]" class="border rounded ml-2">
                                        <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                    </select>
                                </div>
                            </div>`;
                        container.insertAdjacentHTML('beforeend', html);
                        questionCount++;
                    });
                </script>
            </div>

            <div class="mt-8">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition">
                    Terbitkan Tugas
                </button>
            </div>
        </form>
    </div>
</div>
@endsection