@extends('layouts.app', ['title' => 'Daftar Materi'])

@section('content')
<div class="lg:hidden p-4">
    <button id="hamburgerBtn" class="p-2 border rounded-lg">☰</button>
</div>

<div class="flex">
    {{-- SIDEBAR (Sama seperti di dashboard) --}}
    <aside id="sidebar" class="bg-white border-r w-64 min-h-screen py-8 px-5 space-y-4 fixed lg:static inset-y-0 left-0 z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
        <h1 class="text-xl font-bold mb-6">Logo</h1>
        <nav class="space-y-2">
            <a href="{{ url('/siswa/dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100">🏠 Dashboard</a>
            <a href="{{ route('siswa.materials.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg border border-blue-500 bg-blue-50 text-blue-600 font-semibold">📄 Materials</a>
            <!-- <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">📚 Classes</a>
            <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">📝 Assignments</a> -->
        </nav>
    </aside>

    {{-- OVERLAY --}}
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden"></div>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold">Semua Materi</h1>
            <p class="text-gray-500">Pilih materi yang ingin Anda pelajari atau kerjakan.</p>
        </div>

        <div class="bg-white border rounded-lg shadow-sm">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="font-semibold text-lg">Daftar Materi Tersedia</h2>
                <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2.5 py-0.5 rounded-full">
                    {{ $materials->count() }} Materi
                </span>
            </div>
            
            <div class="divide-y">
                @forelse ($materials as $material)
                    <div class="p-4 hover:bg-gray-50 transition flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center shrink-0 font-bold text-xl">
                                📄
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800">{{ $material->title }}</h3>
                                <p class="text-sm text-gray-500 line-clamp-1">{{ $material->description }}</p>
                                <div class="flex gap-3 mt-2">
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">⏱ {{ $material->duration }} Menit</span>
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">📊 {{ $material->tasks->count() }} Soal</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('siswa.materials.show', $material->id) }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-center font-medium transition">
                            Mulai Kerjakan
                        </a>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <p class="text-gray-500 italic">Belum ada materi yang tersedia untuk Anda.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    // Script Sidebar sama seperti sebelumnya
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