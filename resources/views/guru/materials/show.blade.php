@extends('layouts.app', ['title' => $material->title])

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
<aside id="sidebar"
    class="bg-white border-r w-64 min-h-screen py-8 px-5 p-5 space-y-4 
           fixed lg:static inset-y-0 left-0 z-40 transform -translate-x-full 
           lg:translate-x-0 transition-transform duration-300">

    <h1 class="text-xl font-bold mb-6">Logo</h1>

    {{-- MENU LIST --}}
    <nav class="space-y-2 mt-4">

        {{-- DASHBOARD (ACTIVE) --}}
        <a href="{{ url('/guru/dashboard') }}"
            class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
            <span>📊</span> Dashboard
        </a>

        <a href="{{ url('/guru/students') }}"
            class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
            <span>👥</span> Students
        </a>

        <a href="{{ url('/guru/materials') }}" 
            class="flex items-center gap-2 px-3 py-2 rounded-lg 
                   border border-blue-500 bg-blue-50 text-blue-600 font-semibold">
            <span>📄</span> Materi
        </a>

        <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
            <span>📝</span> Assignments
        </a>

        <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
            <span>🎓</span> Grades
        </a>

        <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
            <span>💬</span> Discussions
        </a>

        <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
            <span>📅</span> Calendar
        </a>

        <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
            <span>📢</span> Announcement
        </a>

    </nav>
</aside>


    {{-- OVERLAY (MOBILE ONLY) --}}
    <div id="overlay"
        class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden">
    </div>

<div class="max-w-4xl mx-auto py-6">

    <h1 class="text-2xl font-semibold mb-2">{{ $material->title }}</h1>
    <p class="text-gray-600 mb-6">{{ $material->description }}</p>

    {{-- ================================ --}}
    {{-- FORM TAMBAH TUGAS --}}
    {{-- ================================ --}}
    <div class="bg-white p-4 border rounded-lg mb-6">
        <h2 class="font-semibold mb-3">Tambah Tugas</h2>

        <form action="{{ route('guru.tasks.store', $material->id) }}" method="POST">
            @csrf

            <label class="block mb-1 font-medium">Jenis Tugas</label>
            <select name="type" id="task-type" class="border p-2 rounded w-full mb-3">
                <option value="multiple_choice">Pilihan Ganda</option>
                <option value="essay">Essay</option>
            </select>

            <label class="block mb-1 font-medium">Pertanyaan</label>
            <textarea name="question" class="border p-2 rounded w-full mb-3" required></textarea>

            {{-- Form Pilihan Ganda --}}
            <div id="mcq-fields">
                <input type="text" name="option_a" placeholder="Opsi A" class="border p-2 rounded w-full mb-2">
                <input type="text" name="option_b" placeholder="Opsi B" class="border p-2 rounded w-full mb-2">
                <input type="text" name="option_c" placeholder="Opsi C" class="border p-2 rounded w-full mb-2">
                <input type="text" name="option_d" placeholder="Opsi D" class="border p-2 rounded w-full mb-2">

                <label class="block mb-1 font-medium">Jawaban Benar</label>
                <select name="correct_answer" class="border p-2 rounded w-full mb-3">
                    <option value="">-- Pilih Jawaban --</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Simpan Tugas
            </button>

        </form>
    </div>

    {{-- ================================ --}}
    {{-- LIST TUGAS --}}
    {{-- ================================ --}}
    <div class="bg-white p-4 border rounded-lg">
        <h2 class="font-semibold mb-3">Daftar Tugas</h2>

        @forelse ($material->tasks as $task)
            <div class="border-b py-3">

                {{-- ============================= --}}
                {{-- NOMOR SOAL (DITAMBAHKAN) --}}
                {{-- ============================= --}}
                <p class="font-bold text-lg">Soal {{ $loop->iteration }}</p>

                <p class="text-sm font-semibold text-blue-600">{{ strtoupper($task->type) }}</p>
                <p>{{ $task->question }}</p>

                @if($task->type === 'multiple_choice')
                    <ul class="mt-2 text-gray-700 text-sm">
                        <li>A. {{ $task->option_a }}</li>
                        <li>B. {{ $task->option_b }}</li>
                        <li>C. {{ $task->option_c }}</li>
                        <li>D. {{ $task->option_d }}</li>
                        <li class="mt-1 text-green-600 font-semibold">
                            Jawaban Benar: {{ $task->correct_answer }}
                        </li>
                    </ul>
                @endif
            </div>
        @empty
            <p class="text-gray-500">Belum ada tugas</p>
        @endforelse
    </div>

</div>

{{-- Script untuk hide/unhide form pilihan ganda --}}
<script>
    const typeSelect = document.getElementById('task-type');
    const mcqFields = document.getElementById('mcq-fields');

    function toggleFields() {
        if (typeSelect.value === 'essay') {
            mcqFields.style.display = 'none';
        } else {
            mcqFields.style.display = 'block';
        }
    }

    typeSelect.addEventListener('change', toggleFields);

    // Run on page load
    toggleFields();
</script>

@endsection
