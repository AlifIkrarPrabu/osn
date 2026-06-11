@extends('layouts.app', ['title' => 'Detail Diskusi'])

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
    
<div class="p-6 max-w-4xl">
    <a href="{{ route('guru.discussions.index', ['class_id' => $topic->classroom_id]) }}" class="text-sm font-semibold text-blue-600 hover:underline">← Kembali ke Forum</a>
    
    <div class="bg-white border rounded-xl p-6 shadow-sm mt-4 mb-6">
        <div class="flex justify-between items-center mb-3">
            <div class="flex items-center gap-2">
                <span class="font-bold text-gray-800">{{ $topic->user->name }}</span>
                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded">{{ ucfirst($topic->user->role) }}</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs text-gray-400">{{ $topic->created_at->format('d M Y, H:i') }}</span>
                <form action="{{ route('guru.discussions.destroy_topic', $topic->id) }}" method="POST" onsubmit="return confirm('Hapus topik diskusi ini beserta seluruh komentarnya?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-xs text-red-500 font-semibold hover:underline">Hapus</button>
                </form>
            </div>
        </div>
        <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ $topic->title }}</h2>
        <p class="text-gray-700 whitespace-pre-line text-base">{{ $topic->content }}</p>
    </div>

    <h3 class="text-lg font-bold text-gray-800 mb-4">💬 Balasan ({{ $topic->replies->count() }})</h3>
    <div class="space-y-4 mb-6">
        @forelse($topic->replies as $reply)
            <div class="bg-gray-50 border rounded-xl p-4 ml-6 shadow-2xs">
                <div class="flex justify-between items-center mb-2">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-sm text-gray-800">{{ $reply->user->name }}</span>
                        <span class="text-[10px] {{ $reply->user->isGuru() ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }} px-1.5 py-0.5 rounded font-medium">
                            {{ ucfirst($reply->user->role) }}
                        </span>
                    </div>
                    <span class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-gray-700 text-sm whitespace-pre-line">{{ $reply->content }}</p>
            </div>
        @empty
            <p class="text-gray-400 italic ml-6">Belum ada balasan. Jadilah yang pertama memberikan tanggapan!</p>
        @endforelse
    </div>

    <div class="bg-white border rounded-xl p-5 shadow-sm ml-6">
        <h4 class="font-bold text-gray-800 mb-3 text-sm">Tulis Balasan Anda:</h4>
        <form action="{{ route('guru.discussions.store_reply', $topic->id) }}" method="POST" class="space-y-3">
            @csrf
            <textarea name="content" rows="3" required placeholder="Ketik tanggapan Anda di sini..." class="w-full border rounded-lg px-3 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none text-sm"></textarea>
            <button type="submit" class="bg-blue-600 text-white font-bold px-4 py-2 text-sm rounded-lg hover:bg-blue-700 transition">Kirim Komentar</button>
        </form>
    </div>
</div>
@endsection