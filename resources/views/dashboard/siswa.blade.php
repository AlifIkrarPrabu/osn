@extends('layouts.app', ['title' => 'Dashboard Siswa'])

@section('content')

{{-- =========================== --}}
{{-- HAMBURGER (MOBILE ONLY) --}}
{{-- =========================== --}}
<div class="lg:hidden p-4">
    <button id="hamburgerBtn" class="p-2 border rounded-lg">
        ☰
    </button>
</div>

<div class="flex">

    {{-- =========================== --}}
    {{-- SIDEBAR --}}
    {{-- =========================== --}}
    <aside id="sidebar"
        class="bg-white border-r w-64 min-h-screen py-8 px-5 space-y-4 
               fixed lg:static inset-y-0 left-0 z-40 transform -translate-x-full 
               lg:translate-x-0 transition-transform duration-300">

        <h1 class="text-xl font-bold mb-6">Logo</h1>

        <nav class="space-y-2 mt-4">

            {{-- ACTIVE --}}
            <a href="{{ url('/siswa/dashboard') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg 
                      border border-blue-500 bg-blue-50 text-blue-600 font-semibold">
                <span>🏠</span> Dashboard
            </a>

            <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
                <span>📚</span> Classes
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

    {{-- =========================== --}}
    {{-- MAIN CONTENT --}}
    {{-- =========================== --}}
    <div class="flex-1 p-6">

        <h1 class="text-3xl font-bold mb-6">
            Student Dashboard
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- ================= CURRENT CLASSES ================= --}}
            <div class="bg-white border rounded-lg p-4 shadow-sm">

                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-xl font-semibold">Current Materials</h2>
                    <span class="text-sm text-gray-500">
                        Total: {{ $materials->count() }}
                    </span>
                </div>

                <div class="border rounded-lg p-4 space-y-3">

                    @forelse ($materials as $material)
                        <div class="flex items-center justify-between p-3 border rounded-lg hover:bg-gray-50 transition">
                            <div>
                                <h3 class="font-semibold text-gray-800">
                                    {{ $material->title }}
                                </h3>
                                <p class="text-sm text-gray-500">
                                    {{ Str::limit($material->description, 60) }}
                                </p>
                            </div>

                            <span class="text-gray-400">›</span>
                        </div>
                    @empty
                        <p class="text-center text-gray-400">
                            Belum ada materi
                        </p>
                    @endforelse

                </div>
            </div>

            {{-- ================= UPCOMING ASSIGNMENTS ================= --}}
            <div class="bg-white border rounded-lg p-4 shadow-sm">
                <h2 class="text-xl font-semibold mb-3">Upcoming Assignments</h2>

                <div class="border rounded-lg p-4 flex gap-3">
                    <div class="w-10 h-10 bg-gray-200 rounded flex items-center justify-center">
                        📝
                    </div>

                    <div class="flex-1">
                        <p class="font-semibold">Tugas Matematika</p>
                        <p class="text-sm text-gray-500">Deadline: 20 Mei</p>
                    </div>

                    <button class="border px-4 py-1 rounded-lg">
                        View More
                    </button>
                </div>
            </div>

            {{-- ================= GRADES ================= --}}
            <div class="bg-white border rounded-lg p-4 shadow-sm">
                <h2 class="text-xl font-semibold mb-3">Grades</h2>

                <div class="border rounded-lg p-4">
                    <div class="w-full h-28 bg-gray-200 rounded"></div>
                </div>

                <button class="mt-4 border px-4 py-1 rounded-lg">
                    View More
                </button>
            </div>

            {{-- ================= ASSIGNMENTS ================= --}}
            <div class="bg-white border rounded-lg p-4 shadow-sm">
                <h2 class="text-xl font-semibold mb-3">Assignments</h2>

                <div class="space-y-2">
                    <div class="h-3 bg-gray-300 rounded w-3/4"></div>
                    <div class="h-3 bg-gray-300 rounded w-2/3"></div>
                </div>

                <button class="mt-4 border px-4 py-1 rounded-lg">
                    View More
                </button>
            </div>

        </div>

    </div>
</div>

{{-- =========================== --}}
{{-- SCRIPT --}}
{{-- =========================== --}}
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
