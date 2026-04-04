@extends('layouts.app', ['title' => 'Manage Classes'])

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

            <a href="{{ url('/guru/dashboard') }}"
                class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
                <span>📊</span> Dashboard
            </a>

            <a href="{{ url('/guru/students') }}"
                class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
                <span>👥</span> Students
            </a>

            <a href="{{ url('/guru/materials') }}" 
                class="flex items-center gap-2 px-3 py-2 rounded-lg">
                <span>📄</span> Materi
            </a>

            <a href="{{ route('guru.classes.index') }}" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg border border-blue-500 bg-blue-50 text-blue-600 font-semibold">
                <span>📝</span> Classes
            </a>

            <!-- <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
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
            </a> -->

        </nav>
    </aside>

    {{-- =========================== --}}
    {{-- OVERLAY (MOBILE ONLY) --}}
    {{-- =========================== --}}
    <div id="overlay"
        class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden">
    </div>
    
<div class="container mx-auto p-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('guru.classes.index') }}" class="text-blue-600 hover:underline mr-4 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Atur Materi untuk: <span class="text-blue-600">{{ $class->name }}</span></h1>
        </div>

        <div class="bg-white rounded-lg shadow-md p-8 border border-gray-100">
            <form action="{{ route('guru.classes.update_materials', $class->id) }}" method="POST">
                @csrf
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Daftar Materi Anda</h2>
                    <p class="text-sm text-gray-500">Centang materi yang ingin dihubungkan dengan kelas ini. Materi yang sama bisa digunakan di banyak kelas.</p>
                </div>

                <div class="grid grid-cols-1 gap-4 mb-8">
                    @forelse($allMaterials as $materi)
                        <label class="group flex items-center p-4 border rounded-xl cursor-pointer hover:bg-blue-50 hover:border-blue-300 transition-all">
                            <div class="flex items-center h-5">
                                <input name="materials[]" type="checkbox" value="{{ $materi->id }}" 
                                    {{ in_array($materi->id, $selectedMaterials) ? 'checked' : '' }}
                                    class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            </div>
                            <div class="ml-4 flex-grow">
                                <span class="block text-sm font-bold text-gray-700 group-hover:text-blue-700">
                                    {{ $materi->title }}
                                </span>
                                <span class="text-xs text-gray-400 italic">Dibuat pada: {{ $materi->created_at->format('d M Y') }}</span>
                            </div>
                            @if(in_array($materi->id, $selectedMaterials))
                                <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded">Terhubung</span>
                            @endif
                        </label>
                    @empty
                        <div class="p-8 text-center bg-gray-50 rounded-xl border-2 border-dashed">
                            <p class="text-gray-500">Anda belum membuat materi apapun.</p>
                            <a href="{{ route('guru.materials.create') }}" class="text-blue-600 hover:underline mt-2 inline-block font-medium">Buat Materi Sekarang</a>
                        </div>
                    @endforelse
                </div>

                @if($allMaterials->count() > 0)
                    <div class="flex items-center justify-end pt-6 border-t">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 px-8 rounded-lg shadow-md transition duration-200">
                            Simpan Perubahan
                        </button>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection