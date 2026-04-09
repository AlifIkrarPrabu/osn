@extends('layouts.app', ['title' => 'Dashboard Siswa'])

@section('content')

<div class="lg:hidden p-4">
    <button id="hamburgerBtn" class="p-2 border rounded-lg">☰</button>
</div>

<div class="flex">

    {{-- SIDEBAR --}}
    <aside id="sidebar"
        class="bg-white border-r w-64 min-h-screen py-8 px-5 space-y-4 
        fixed lg:static inset-y-0 left-0 z-40 transform -translate-x-full 
        lg:translate-x-0 transition-transform duration-300">

        <h1 class="text-xl font-bold mb-6">Logo</h1>

        <nav class="space-y-2">
            <a href="{{ url('/siswa/dashboard') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg 
               border border-blue-500 bg-blue-50 text-blue-600 font-semibold">
                🏠 Dashboard
            </a>
            <a href="{{ route('siswa.classes.index') }}" 
                class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('siswa/materials*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
                🏫 Classes
            </a>
            <a href="{{ route('siswa.materials.index') }}" 
                class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('siswa/materials*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
                📄 Materials
            </a>
            
        </nav>
    </aside>

    {{-- OVERLAY --}}
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden"></div>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold mb-6">Student Dashboard</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- CURRENT MATERIALS --}}
            <div class="bg-white border rounded-lg p-4 shadow-sm">
                <div class="flex justify-between mb-4">
                    <h2 class="text-xl font-semibold">Current Materials</h2>
                    <span class="text-sm text-gray-500">Total: {{ $materials->count() }}</span>
                </div>

                <div class="space-y-3">
                    @foreach ($materials as $material)
                        <a href="{{ route('siswa.materials.show', $material->id) }}"
                           class="block border rounded-lg p-4 hover:bg-gray-50 transition">

                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="font-semibold">{{ $material->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $material->description }}</p>
                                </div>
                                <span class="text-blue-600 font-medium">Lihat Soal →</span>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="flex justify-end mt-4">
                    <a href="{{ route('siswa.materials.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                        View More
                    </a>
                </div>
            </div>

            {{-- MY CLASSES (BAGIAN BARU) --}}
            <div class="bg-white border rounded-lg p-4 shadow-sm">
                <h2 class="text-xl font-semibold mb-4">Kelas Saya</h2>
                
                <div class="space-y-3">
                    @forelse($myClasses as $class)
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 bg-blue-500 text-white rounded-lg flex items-center justify-center shadow-sm">
                                    🏫
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">{{ $class->name }}</h3>
                                    
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center pt-2 border-t border-gray-200 mt-2">
                                <span class="text-sm text-gray-600">{{ $class->materials->count() }} Materi Tersedia</span>
                                <a href="{{ route('siswa.classes.index') }}" 
                                    class="text-sm font-semibold text-blue-600 hover:underline">
                                        View More →
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="border-2 border-dashed rounded-lg p-8 text-center">
                            <p class="text-gray-400 italic">Anda belum terdaftar di kelas manapun.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>

<script>
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');
const btn = document.getElementById('hamburgerBtn');

btn?.addEventListener('click', () => {
    sidebar.classList.remove('-translate-x-full');
    overlay.classList.remove('hidden');
});

overlay?.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
});
</script>

@endsection