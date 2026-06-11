@extends('layouts.app', ['title' => 'Diskusi Kelas'])

@section('content')
<div class="lg:hidden p-4">
    <button id="hamburgerBtn" class="p-2 border rounded-lg">☰</button>
</div>

<div class="flex">
    @include('partials.sidebar-siswa')
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden"></div>

    <div class="flex-1 p-6">
        @if(!$classroom)
            <div class="border-2 border-dashed rounded-xl p-12 text-center bg-white max-w-4xl">
                <p class="text-gray-400 italic">Anda belum didaftarkan ke kelas manapun oleh Guru. Menu diskusi belum tersedia.</p>
            </div>
        @else
            <h1 class="text-3xl font-bold mb-2">💬 Forum Diskusi</h1>
            <p class="text-gray-500 mb-6 font-semibold">Ruang Belajar: <span class="text-blue-600">{{ $classroom->name }}</span></p>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4 max-w-5xl">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-6xl">
                <div class="lg:col-span-2 space-y-4">
                    @forelse($topics as $topic)
                        <div class="bg-white border rounded-xl p-5 shadow-sm flex flex-col justify-between hover:border-blue-300 transition">
                            <div>
                                <div class="flex justify-between items-start mb-2">
                                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded font-semibold">
                                        👤 {{ $topic->user->name }} ({{ ucfirst($topic->user->role) }})
                                    </span>
                                    <span class="text-xs text-gray-400">{{ $topic->created_at->diffForHumans() }}</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $topic->title }}</h3>
                                <p class="text-gray-600 text-sm line-clamp-2 mb-4">{{ $topic->content }}</p>
                            </div>
                            <div class="flex justify-between items-center border-t pt-3 text-sm">
                                <span class="text-gray-500">💬 {{ $topic->replies->count() }} Balasan</span>
                                <a href="{{ route('siswa.discussions.show', $topic->id) }}" class="text-blue-600 font-bold hover:underline">Ikut Diskusi →</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-400 italic">Belum ada obrolan di kelas ini. Jadilah pelopor diskusi!</p>
                    @endforelse
                </div>

                <div>
                    <div class="bg-white border rounded-xl p-5 shadow-sm sticky top-6">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">Tanyakan Sesuatu Ke Kelas</h2>
                        <form action="{{ route('siswa.discussions.store_topic') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Topik/Pertanyaan</label>
                                <input type="text" name="title" required placeholder="Contoh: Bingung tugas matematika nomor 3" class="w-full border rounded-lg px-3 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Penjelasan Detail</label>
                                <textarea name="content" rows="4" required placeholder="Tulis rincian kesulitan atau bahan obrolan kamu di sini..." class="w-full border rounded-lg px-3 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 outline-none text-sm"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition text-sm">Kirim ke Forum</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

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