@extends('layouts.simple', ['title' => 'Dashboard Guru'])

@section('content')
    <div class="p-6 bg-white shadow-xl rounded-xl max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-yellow-700 mb-4">DASHBOARD GURU</h1>
        
        <p class="text-lg text-gray-700">Halo, Bapak/Ibu <span class="font-semibold">{{ Auth::user()->name }}</span>!</p>
        <p class="text-base text-gray-500 mt-2 mb-6">Di sini Anda dapat mengelola materi, nilai, dan jadwal kelas Anda.</p>
        
        <div class="mt-6 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 rounded-lg">
            <p class="font-bold">PERAN AKTIF:</p>
            <p class="mt-1 text-sm">GURU (Akses pengelolaan)</p>
        </div>
        
        {{-- Tautan "Kelola Profil Anda" dihapus --}}
    </div>
@endsection
