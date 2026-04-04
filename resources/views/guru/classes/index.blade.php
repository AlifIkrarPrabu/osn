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

        <h1 class="text-xl font-bold mb-6">SOC Indonesia</h1>

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
        </nav>
    </aside>

    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden"></div>

    <div class="container mx-auto p-6">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Kelas</h1>
                
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
                    <div class="border rounded-xl p-5 hover:shadow-lg transition bg-white border-gray-200">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-gray-800">{{ $class->name }}</h3>
                            <span class="bg-blue-50 text-blue-600 text-xs font-medium px-2.5 py-0.5 rounded-full border border-blue-100">
                                {{ $class->materials->count() }} Materi
                            </span>
                        </div>
                        
                        <p class="text-sm text-gray-500 mb-4">Dibuat pada: {{ $class->created_at->format('d M Y') }}</p>
                        
                        <div class="flex flex-col gap-2 pt-4 border-t border-gray-100">
                            {{-- TOMBOL KELOLA MATERI (HIJAU) --}}
                            <a href="{{ route('guru.classes.manage', $class->id) }}" 
                               class="flex items-center justify-center gap-2 w-full px-4 py-2 bg-green-50 text-green-700 text-sm font-semibold rounded-lg hover:bg-green-100 transition">
                                <span>📄</span> Kelola Materi
                            </a>

                            {{-- TOMBOL KELOLA SISWA (ORANGE/KUNING) --}}
                            <a href="{{ route('guru.classes.show', $class->id) }}" 
                               class="flex items-center justify-center gap-2 w-full px-4 py-2 bg-amber-50 text-amber-700 text-sm font-semibold rounded-lg hover:bg-amber-100 transition">
                                <span>👥</span> Kelola Siswa
                            </a>

                            {{-- TOMBOL HAPUS (MERAH) --}}
                            <form action="{{ route('guru.classes.destroy', $class->id) }}" method="POST" 
                                 onsubmit="return confirm('Hapus kelas ini? Semua data di dalamnya akan hilang.')" class="mt-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-center text-xs text-red-400 hover:text-red-600 transition">
                                    Hapus Kelas
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-10 text-center text-gray-400 italic border-2 border-dashed rounded-xl">
                        Belum ada kelas.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection