@extends('layouts.app', ['title' => 'Kelola Siswa'])

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
                class="flex items-center gap-2 px-3 py-2 rounded-lg">
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
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Siswa</h1>
            <p class="text-gray-600">Kelas: <span class="font-semibold text-blue-600">{{ $class->name }}</span></p>
        </div>
        <a href="{{ route('guru.classes.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition text-sm">
            ← Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Form Tambah Siswa (Samping Kiri) --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-700 mb-4 flex items-center gap-2">
                    <span>➕</span> Tambah Siswa
                </h3>
                
                <form action="{{ route('guru.classes.addStudent', $class->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Nama Siswa</label>
                        <select name="student_id" class="w-full border border-gray-300 p-2.5 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($allStudents as $s)
                                <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition shadow-sm">
                        Masukkan ke Kelas
                    </button>
                </form>
            </div>
        </div>

        {{-- Tabel Daftar Siswa (Samping Kanan) --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-700 flex items-center gap-2">
                        <span>👥</span> Daftar Siswa Terdaftar
                    </h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 uppercase text-xs">
                                <th class="px-6 py-4 font-bold border-b">No</th>
                                <th class="px-6 py-4 font-bold border-b">Nama Siswa</th>
                                <th class="px-6 py-4 font-bold border-b">Email</th>
                                <th class="px-6 py-4 font-bold border-b text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @forelse($class->students as $index => $student)
                                <tr class="hover:bg-blue-50 transition border-b border-gray-50">
                                    <td class="px-6 py-4 text-sm">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $student->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $student->email }}</td>
                                    <td class="px-6 py-4 text-center">
                                        {{-- Anda bisa menambahkan tombol hapus siswa dari kelas di sini nanti --}}
                                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Aktif</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">
                                        Belum ada siswa yang ditambahkan ke kelas ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection