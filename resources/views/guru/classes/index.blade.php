@extends('layouts.app', ['title' => 'Classes'])

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
                class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
                <span>📄</span> Materi
            </a>

            <a href="{{ route('guru.classes.index') }}" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg border border-blue-500 bg-blue-50 text-blue-600 font-semibold">
                <span>📝</span> Classes
            </a>

            <!-- <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
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
            </a> -->

        </nav>
    </aside>

    {{-- =========================== --}}
    {{-- OVERLAY (MOBILE ONLY) --}}
    {{-- =========================== --}}
    <div id="overlay"
        class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden">
    </div>

<div class="container mx-auto p-6">
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Kelas</h1>
            
            <!-- Form Sederhana Tambah Kelas -->
            <form action="{{ route('guru.classes.store') }}" method="POST" class="flex gap-2">
                @csrf
                <input type="text" name="name" placeholder="Nama Kelas (Contoh: XII TKJ 1)" 
                    class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none w-64" required>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    + Tambah Kelas
                </button>
            </form>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($classes as $class)
                <div class="border rounded-xl p-5 hover:shadow-lg transition bg-gray-50">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-700">{{ $class->name }}</h3>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                            {{ $class->materials_count }} Materi
                        </span>
                    </div>
                    
                    <p class="text-sm text-gray-500 mb-4">Dibuat pada: {{ $class->created_at->format('d M Y') }}</p>
                    
                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-200">
                        <a href="{{ route('guru.classes.manage', $class->id) }}" 
                           class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-800">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Kelola Materi
                        </a>

                        <form action="{{ route('guru.classes.destroy', $class->id) }}" method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-medium">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-10 text-center text-gray-500 italic border-2 border-dashed rounded-xl">
                    Belum ada kelas yang dibuat. Silakan tambah kelas baru di atas.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection