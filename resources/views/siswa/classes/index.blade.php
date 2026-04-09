@extends('layouts.app', ['title' => 'My Classes'])

@section('content')
<div class="lg:hidden p-4">
    <button id="hamburgerBtn" class="p-2 border rounded-lg">☰</button>
</div>

<div class="flex">
    {{-- SIDEBAR --}}
    <aside id="sidebar" class="bg-white border-r w-64 min-h-screen py-8 px-5 space-y-4 fixed lg:static inset-y-0 left-0 z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
        <h1 class="text-xl font-bold mb-6">Logo</h1>
        <nav class="space-y-2">
            <a href="{{ url('/siswa/dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100">🏠 Dashboard</a>
            <a href="{{ route('siswa.classes.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('siswa.classes.*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">🏫 Classes</a>
            <a href="{{ route('siswa.materials.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100">📄 Materials</a>
        </nav>
    </aside>

    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden"></div>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Kelas Saya</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($myClasses as $class)
            <div class="bg-white border rounded-xl p-5 shadow-sm hover:shadow-md transition">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-3 bg-blue-100 text-blue-600 rounded-lg">
                        <span>🏫</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-800">{{ $class->name }}</h3>
                        <p class="text-xs text-gray-500">
                            Terdaftar: {{ $class->pivot->created_at?->format('d M Y') ?? 'Baru' }}
                        </p>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <div class="flex justify-between text-sm mb-4 text-gray-600">
                        <span>Materi Tersedia</span>
                        <span class="font-bold">{{ $class->materials->count() }}</span>
                    </div>
                    <a href="{{ route('siswa.materials.index', ['class_id' => $class->id]) }}" 
                       class="block w-full text-center py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                        Buka Materi
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center bg-gray-50 border-2 border-dashed rounded-xl">
                <p class="text-gray-400">Anda belum terdaftar di kelas manapun.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection