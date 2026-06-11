@extends('layouts.app', ['title' => 'Kelola Pengumuman'])

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
    <h1 class="text-3xl font-bold mb-6">📢 Kelola Pengumuman Kelas</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4 max-w-5xl">{{ session('success') }}</div>
    @endif

    <div class="bg-white border rounded-xl p-5 shadow-sm mb-8 max-w-md">
        <form action="{{ route('guru.announcements.index') }}" method="GET" class="space-y-3">
            <label class="block font-semibold text-gray-700">Pilih Kelas Mading Digital:</label>
            <div class="flex gap-3">
                <select name="class_id" class="flex-1 border rounded-lg px-3 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($classrooms as $class)
                        <option value="{{ $class->id }}" {{ $selectedClassId == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-600 text-white font-bold px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">Buka</button>
            </div>
        </form>
    </div>

    @if($selectedClassId)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-6xl">
            <div class="lg:col-span-2 space-y-4">
                <h2 class="text-xl font-bold text-gray-800">Riwayat Pengumuman</h2>
                
                @forelse($announcements as $announce)
                    <div class="bg-white border rounded-xl p-5 shadow-sm border-l-4 border-l-blue-600 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded font-semibold">
                                    Oleh: {{ $announce->user->name }}
                                </span>
                                <div class="flex items-center gap-3">
                                    <span class="text-xs text-gray-400">{{ $announce->created_at->format('d M Y, H:i') }}</span>
                                    <form action="{{ route('guru.announcements.destroy', $announce->id) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs text-red-500 font-bold hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $announce->title }}</h3>
                            <p class="text-gray-700 text-sm whitespace-pre-line">{{ $announce->content }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 italic">Belum ada pengumuman yang dikirim ke kelas ini.</p>
                @endforelse
            </div>

            <div>
                <div class="bg-white border rounded-xl p-5 shadow-sm sticky top-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Buat Pengumuman Baru</h2>
                    <form action="{{ route('guru.announcements.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="classroom_id" value="{{ $selectedClassId }}">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Informasi</label>
                            <input type="text" name="title" required placeholder="Contoh: Perubahan Jadwal Remedial" class="w-full border rounded-lg px-3 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Isi Pengumuman</label>
                            <textarea name="content" rows="6" required placeholder="Tulis rincian berita atau pengumuman resmi di sini..." class="w-full border rounded-lg px-3 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none text-sm"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition text-sm">Terbitkan Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="border-2 border-dashed rounded-xl p-12 text-center bg-white max-w-5xl">
            <p class="text-gray-400 italic">Silakan pilih kelas terlebih dahulu untuk melihat atau menerbitkan pengumuman.</p>
        </div>
    @endif
</div>
@endsection