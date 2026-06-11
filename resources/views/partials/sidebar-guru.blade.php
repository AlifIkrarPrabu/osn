{{-- resources/views/partials/sidebar-guru.blade.php --}}
<aside id="sidebar"
    class="bg-white border-r w-64 min-h-screen py-8 px-5 p-5 space-y-4 
           fixed lg:static inset-y-0 left-0 z-40 transform -translate-x-full 
           lg:translate-x-0 transition-transform duration-300">

    <h1 class="text-xl font-bold mb-6">SOC Indonesia</h1>

    {{-- MENU LIST --}}
    <nav class="space-y-2 mt-4">

        {{-- Dashboard --}}
        <a href="{{ url('/guru/dashboard') }}"
            class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('guru/dashboard*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
            <span>🏠</span> Dashboard
        </a>

        {{-- Students --}}
        <a href="{{ url('/guru/students') }}"
            class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('guru/students*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
            <span>👥</span> Students
        </a>

        {{-- Materi --}}
        <a href="{{ url('/guru/materials') }}" 
            class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('guru/materials*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
            <span>📄</span> Materi
        </a>

        {{-- Classes --}}
        <a href="{{ route('guru.classes.index') }}" 
            class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('guru/classes*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
            <span>🏫</span> Classes
        </a>

        {{-- Assignments --}}
        <a href="{{ route('guru.assignments.index') }}" 
            class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('guru/assignments*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
            <span>📚</span> Assignments
        </a>

        {{-- Rekap Nilai (Grades)--}}
        <a href="{{ route('guru.grades.index') }}" 
            class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('guru/grades*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
            <span>📊</span> Grades
        </a>

        <a href="{{ route('guru.discussions.index') }}" 
            class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('guru/discussions*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
                <span>💬</span> Discussions
        </a>
        
        <a href="{{ route('guru.calendar.index') }}" 
            class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('guru/calendar*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
                <span>📅</span> Calendar
        </a>

        <a href="{{ route('guru.announcements.index') }}" 
            class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('guru/announcements*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
                <span>📢</span> Announcement
        </a>

    </nav>
</aside>