@extends('layouts.simple', ['title' => 'Dashboard Siswa'])

@section('content')
    <div class="p-6 bg-white shadow-xl rounded-xl max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-green-700 mb-4">DASHBOARD SISWA</h1>
        
        <p class="text-lg text-gray-700">Selamat belajar, <span class="font-semibold">{{ Auth::user()->name }}</span>!</p>
        <p class="text-base text-gray-500 mt-2 mb-6">Anda dapat melihat nilai, tugas, dan materi pelajaran Anda di sini.</p>
        
        <div class="mt-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded-lg">
            <p class="font-bold">PERAN AKTIF:</p>
            <p class="mt-1 text-sm">SISWA (Akses terbatas)</p>
        </div>
        
        {{-- Tautan "Kelola Profil Anda" dihapus --}}
    </div>
@endsection
