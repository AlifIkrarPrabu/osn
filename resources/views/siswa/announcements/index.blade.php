@extends('layouts.app', ['title' => 'Pengumuman Kelas'])

@section('content')
<div class="lg:hidden p-4">
    <button id="hamburgerBtn" class="p-2 border rounded-lg">☰</button>
</div>

<div class="flex">
    @include('partials.sidebar-siswa')
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden"></div>

    <div class="flex-1 p-6 max-w-4xl">
        @if(!$classroom)
            <div class="border-2 border-dashed rounded-xl p-12 text-center bg-white">
                <p class="text-gray-400 italic">Anda belum masuk kelas manapun. Papan pengumuman kosong.</p>
            </div>
        @else
            <h1 class="text-3xl font-bold mb-2">📢 Papan Pengumuman Kelas</h1>
            <p class="text-gray-500 mb-8 font-semibold">Informasi resmi dari Guru Kelas: <span class="text-blue-600">{{ $classroom->name }}</span></p>

            <div class="space-y-6">
                @forelse($announcements as $announce)
                    <div class="bg-white border rounded-xl p-6 shadow-sm border-l-4 border-l-osnBlue hover:shadow-md transition">
                        <div class="flex justify-between items-center mb-3 text-xs text-gray-400 font-medium">
                            <span class="bg-blue-50 text-osnBlue px-2 py-1 rounded-md font-bold">
                                👨‍🏫 {{ $announce->user->name }} (Guru)
                            </span>
                            <span>{{ $announce->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-3">{{ $announce->title }}</h2>
                        <p class="text-gray-700 text-sm whitespace-pre-line leading-relaxed">{{ $announce->content }}</p>
                    </div>
                @empty
                    <div class="bg-white border rounded-xl p-8 text-center text-gray-400 italic">
                        Belum ada pengumuman resmi yang diterbitkan untuk kelas Anda minggu ini.
                    </div>
                @endforelse
            </div>
        @endif
    </div>
</div>

<script>
// Script Hamburger Sidebar Responsif Siswa
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