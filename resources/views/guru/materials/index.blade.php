@extends('layouts.app', ['title' => 'Materi'])

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

    {{-- =========================== --}}
    {{-- KONTEN KANAN (DIPERBAIKI) --}}
    {{-- =========================== --}}
    <div class="flex-1 ml-0 lg:ml-0 p-6">

        <div class="flex justify-between mb-4">
            <h1 class="text-xl font-semibold">Daftar Materi</h1>

            <a href="{{ route('guru.materials.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                + Tambah Materi
            </a>
        </div>

        <div class="bg-white border rounded-lg p-4">

            @forelse ($materials as $material)
                <a href="{{ route('guru.materials.show', $material->id) }}"
                   class="block border-b py-3 hover:bg-gray-50">
                    <h2 class="font-semibold text-lg">{{ $material->title }}</h2>
                    <p class="text-sm text-gray-600">{{ $material->description ?? '-' }}</p>
                </a>
            @empty
                <p class="text-gray-500">Belum ada materi</p>
            @endforelse

        </div>

    </div>

</div>

@endsection
