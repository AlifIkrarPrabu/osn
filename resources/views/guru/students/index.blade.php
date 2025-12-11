@extends('layouts.app', ['title' => 'Daftar Siswa'])

@section('content')

{{-- =========================== --}}
{{-- HAMBURGER (MOBILE ONLY) --}}
{{-- =========================== --}}
<div class="lg:hidden p-4">
    <button id="hamburgerBtn" class="p-2 border rounded-lg">
        ☰
    </button>
</div>

{{-- WRAPPER --}}
<div class="flex">

    {{-- SIDEBAR --}}
    <aside id="sidebar"
        class="bg-white border-r w-64 min-h-screen py-8 px-5 p-5 space-y-4 
               fixed lg:static inset-y-0 left-0 z-40 transform -translate-x-full 
               lg:translate-x-0 transition-transform duration-300">

        <h1 class="text-xl font-bold mb-6">Logo</h1>

        <nav class="space-y-2 mt-4">
            <a href="{{ url('/guru/dashboard') }}"
               class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
                <span>📊</span> Dashboard
            </a>

            <a href="{{ url('/guru/students') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg 
                      border border-blue-500 bg-blue-50 text-blue-600 font-semibold">
                <span>👥</span> Students
            </a>

            <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
                <span>📄</span> Materials
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

    {{-- OVERLAY --}}
    <div id="overlay"
        class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden">
    </div>

    {{-- CONTENT --}}
    <div class="flex-1 px-6 py-6 ml-64 lg:ml-0">

        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold">Daftar Siswa</h1>
                <p class="text-gray-500 text-sm">
                    Total {{ $students->count() }} siswa ditemukan
                </p>
            </div>

            <form method="GET" action="{{ route('guru.students') }}">
                <input type="text" name="search"
                    value="{{ $search ?? '' }}"
                    placeholder="Cari nama / email siswa..."
                    class="border rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring focus:border-blue-300">
            </form>
        </div>

        <div class="bg-white border rounded-lg shadow overflow-hidden">

            <div class="grid grid-cols-12 gap-4 px-4 py-3 bg-gray-50 font-semibold text-gray-700 border-b">
                <div class="col-span-1">No</div>
                <div class="col-span-4">Nama</div>
                <div class="col-span-5">Email</div>
                <div class="col-span-2">Role</div>
            </div>

            @forelse ($students as $student)
                <div class="grid grid-cols-12 gap-4 px-4 py-3 border-b items-center hover:bg-gray-50">
                    <div class="col-span-1 text-gray-500">{{ $loop->iteration }}</div>
                    <div class="col-span-4 font-medium">{{ $student->name }}</div>
                    <div class="col-span-5 text-sm text-gray-600">{{ $student->email }}</div>
                    <div class="col-span-2">
                        <span class="px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-700">
                            {{ ucfirst($student->role) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500">Tidak ada data siswa</div>
            @endforelse
        </div>

    </div>

</div>
@endsection
