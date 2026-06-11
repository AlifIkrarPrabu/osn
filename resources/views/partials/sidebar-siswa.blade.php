{{-- resources/views/partials/sidebar-siswa.blade.php --}}
<aside id="sidebar"
    class="bg-white border-r w-64 min-h-screen py-8 px-5 space-y-4 
    fixed lg:static inset-y-0 left-0 z-40 transform -translate-x-full 
    lg:translate-x-0 transition-transform duration-300">

    <h1 class="text-xl font-bold mb-6">SOC Indonesia</h1>

    <nav class="space-y-2">
        <a href="{{ url('/siswa/dashboard') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('siswa/dashboard') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
           🏠 Dashboard
        </a>
        <a href="{{ route('siswa.classes.index') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('siswa/classes*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
            🏫 Classes
        </a>
        <a href="{{ route('siswa.materials.index') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('siswa/materials*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
            📄 Materials
        </a>
        <a href="{{ route('siswa.assignments.index') }}" 
           class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('siswa/assignments*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
            📝 Assignments
        </a>
        <a href="{{ route('siswa.grades.index') }}" 
            class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('siswa/grades*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
                📊 Grades
        </a>

        <a href="{{ route('siswa.discussions.index') }}" 
            class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('siswa/discussions*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
                <span>💬</span> Discussions
        </a>

        <a href="{{ route('siswa.calendar.index') }}" 
            class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->is('siswa/calendar*') ? 'border border-blue-500 bg-blue-50 text-blue-600 font-semibold' : 'hover:bg-gray-100' }}">
                <span>📅</span> Calendar
        </a>
    </nav>
</aside>