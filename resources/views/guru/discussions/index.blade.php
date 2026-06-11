@extends('layouts.app', ['title' => 'Forum Diskusi'])

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
   @include('partials.sidebar-guru')

    {{-- =========================== --}}
    {{-- OVERLAY (MOBILE ONLY) --}}
    {{-- =========================== --}}
    <div id="overlay"
        class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden">
    </div>
    
<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">💬 Forum Diskusi Kelas</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4 max-w-4xl">{{ session('success') }}</div>
    @endif

    <div class="bg-white border rounded-xl p-5 shadow-sm mb-8 max-w-md">
        <form action="{{ route('guru.discussions.index') }}" method="GET" class="space-y-3">
            <label class="block font-semibold text-gray-700">Pilih Kelas Diskusi:</label>
            <div class="flex gap-3">
                <select name="class_id" class="flex-1 border rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($classrooms as $class)
                        <option value="{{ $class->id }}" {{ $selectedClassId == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-600 text-white font-bold px-4 py-2 rounded-lg hover:bg-blue-700 transition">Buka</button>
            </div>
        </form>
    </div>

    @if($selectedClassId)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-6xl">
            <div class="lg:col-span-2 space-y-4">
                <h2 class="text-xl font-bold text-gray-800">Topik Diskusi Saat Ini</h2>
                
                @forelse($topics as $topic)
                    <div class="bg-white border rounded-xl p-5 shadow-sm flex flex-col justify-between hover:border-blue-300 transition">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <span class="bg-blue-50 text-blue-600 text-xs px-2 py-1 rounded font-semibold">
                                    Oleh: {{ $topic->user->name }} ({{ ucfirst($topic->user->role) }})
                                </span>
                                <span class="text-xs text-gray-400">{{ $topic->created_at->diffForHumans() }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $topic->title }}</h3>
                            <p class="text-gray-600 text-sm line-clamp-2 mb-4">{{ $topic->content }}</p>
                        </div>
                        <div class="flex justify-between items-center border-t pt-3 text-sm">
                            <span class="text-gray-500">💬 {{ $topic->replies->count() }} Balasan</span>
                            <a href="{{ route('guru.discussions.show', $topic->id) }}" class="text-blue-600 font-bold hover:underline">Ikuti Diskusi →</a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 italic">Belum ada topik diskusi di kelas ini. Mari mulai buat pertanyaan!</p>
                @endforelse
            </div>

            <div>
                <div class="bg-white border rounded-xl p-5 shadow-sm sticky top-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Buat Topik Diskusi Baru</h2>
                    <form action="{{ route('guru.discussions.store_topic') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="classroom_id" value="{{ $selectedClassId }}">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul / Pertanyaan Utama</label>
                            <input type="text" name="title" required placeholder="Contoh: Diskusi Bab 2 Jaringan" class="w-full border rounded-lg px-3 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi / Detail Pertanyaan</label>
                            <textarea name="content" rows="4" required placeholder="Tuliskan petunjuk atau pertanyaan pemantik di sini..." class="w-full border rounded-lg px-3 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition">Terbitkan Topik</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="border-2 border-dashed rounded-xl p-12 text-center bg-white max-w-4xl">
            <p class="text-gray-400 italic">Silakan pilih kelas terlebih dahulu untuk masuk ke ruang forum diskusi.</p>
        </div>
    @endif
</div>
@endsection