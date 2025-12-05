@extends('layouts.app', ['title' => 'Dashboard Guru'])

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

        {{-- DASHBOARD (ACTIVE) --}}
        <a href="{{ url('/guru/dashboard') }}"
            class="flex items-center gap-2 px-3 py-2 rounded-lg 
                   border border-blue-500 bg-blue-50 text-blue-600 font-semibold">
            <span>📊</span> Dashboard
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


    {{-- OVERLAY (MOBILE ONLY) --}}
    <div id="overlay"
        class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden">
    </div>


    {{-- =========================== --}}
    {{-- MAIN CONTENT --}}
    {{-- =========================== --}}
    <div class="flex-1 p-6">

        <h1 class="text-3xl font-bold mb-6">Teacher Dashboard</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- ========= Left Column ========= --}}
            <div class="space-y-6">

                {{-- CLASSES --}}
                <div class="bg-white border rounded-lg p-4 shadow-sm">
                    <h2 class="text-xl font-semibold mb-3">Classes</h2>

                    <div class="border rounded-lg p-4">
                        <div class="flex justify-between text-gray-700 font-semibold mb-2">
                            <span>Name</span>
                            <span>Students</span>
                            <span>Schedule</span>
                        </div>

                        <div class="space-y-2 text-gray-400">
                            <div class="flex justify-between">
                                <span>──────</span>
                                <span>───</span>
                                <span>────</span>
                            </div>
                            <div class="flex justify-between">
                                <span>──────</span>
                                <span>───</span>
                                <span>────</span>
                            </div>
                        </div>

                        <button class="mt-4 border px-4 py-1 rounded-lg">View More</button>
                    </div>
                </div>

                {{-- GRADES --}}
                <div class="bg-white border rounded-lg p-4 shadow-sm">
                    <h2 class="text-xl font-semibold mb-3">Grades</h2>

                    <div class="border rounded-lg p-4">
                        <div class="w-full h-28 bg-gray-200 rounded"></div>

                        <button class="mt-4 border px-4 py-1 rounded-lg">View More</button>
                    </div>
                </div>
            </div>

            {{-- ========= Right Column ========= --}}
            <div class="space-y-6">

                {{-- MATERIALS --}}
                <div class="bg-white border rounded-lg p-4 shadow-sm">
                    <h2 class="text-xl font-semibold mb-3">Materials & Assignments</h2>

                    <div class="border rounded-lg p-4 flex items-start gap-3">
                        <div class="w-10 h-10 bg-gray-300 rounded"></div>

                        <div class="flex-1 space-y-2 text-gray-400">
                            <div class="h-3 bg-gray-300 rounded w-3/4"></div>
                            <div class="h-3 bg-gray-300 rounded w-2/3"></div>
                        </div>

                        <button class="border px-4 py-1 rounded-lg">View More</button>
                    </div>
                </div>

                {{-- DISCUSSION --}}
                <div class="bg-white border rounded-lg p-4 shadow-sm">
                    <h2 class="text-xl font-semibold mb-3">Discussion</h2>

                    <div class="border rounded-lg p-4 flex gap-3">
                        <div class="w-10 h-10 bg-gray-300 rounded"></div>

                        <div class="flex-1 space-y-2 text-gray-400">
                            <div class="h-3 bg-gray-300 rounded w-3/4"></div>
                            <div class="h-3 bg-gray-300 rounded w-2/3"></div>
                        </div>

                        <button class="border px-4 py-1 rounded-lg">View More</button>
                    </div>
                </div>

                {{-- SEEDOM --}}
                <div class="bg-white border rounded-lg p-4 shadow-sm">
                    <h2 class="text-xl font-semibold mb-3">Seedom</h2>

                    <div class="border rounded-lg p-4 space-y-2 text-gray-400">
                        <div class="h-3 bg-gray-300 rounded w-4/5"></div>
                        <div class="h-3 bg-gray-300 rounded w-3/5"></div>

                        <button class="mt-2 border px-4 py-1 rounded-lg">View More</button>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>



{{-- =========================== --}}
{{-- SCRIPT HAMBURGER --}}
{{-- =========================== --}}
<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const btn = document.getElementById('hamburgerBtn');

    // Open sidebar
    btn?.addEventListener('click', () => {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
    });

    // Close sidebar when clicking overlay
    overlay?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>


@endsection
