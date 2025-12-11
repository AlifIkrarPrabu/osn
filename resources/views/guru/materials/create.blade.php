@extends('layouts.app', ['title' => 'Tambah Materi'])

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

    {{-- =========================== --}}
    {{-- OVERLAY (MOBILE ONLY) --}}
    {{-- =========================== --}}
    <div id="overlay"
        class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden">
    </div>

<div class="flex-1 ml-0 lg:ml-0 p-6">

    <h1 class="text-xl font-semibold mb-4">Tambah Materi</h1>

    <form method="POST" action="{{ route('guru.materials.store') }}">
        @csrf

        <div class="mb-3">
            <label class="font-semibold">Judul Materi</label>
            <input type="text" name="title" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="font-semibold">Deskripsi</label>
            <textarea name="description" class="w-full border p-2 rounded"></textarea>
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">
            Simpan
        </button>

    </form>

</div>

@endsection
