@extends('layouts.app', ['title' => 'Nilai Saya'])

@section('content')

<div class="lg:hidden p-4">
    <button id="hamburgerBtn" class="p-2 border rounded-lg">☰</button>
</div>

<div class="flex">

    {{-- PANGGIL SIDEBAR --}}
    @include('partials.sidebar-siswa')

    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden"></div>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold mb-6">Rapor Nilai Saya</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-blue-600 text-white rounded-xl p-6 shadow-sm">
                <p class="text-sm font-medium text-blue-100 uppercase">Rata-Rata Nilai Tugas</p>
                <h3 class="text-4xl font-bold mt-2">{{ $averageScore }} <span class="text-lg text-blue-200">/ 100</span></h3>
            </div>
            <div class="bg-emerald-600 text-white rounded-xl p-6 shadow-sm">
                <p class="text-sm font-medium text-emerald-100 uppercase">Tugas yang Diselesaikan</p>
                <h3 class="text-4xl font-bold mt-2">{{ $completedCount }} <span class="text-lg text-emerald-200">Tugas</span></h3>
            </div>
        </div>

        <div class="bg-white border rounded-xl shadow-sm overflow-hidden">
            <div class="p-5 border-b">
                <h2 class="text-xl font-bold text-gray-800">Rincian Nilai Per Tugas</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-gray-700">Nama Tugas</th>
                            <th class="px-6 py-4 font-semibold text-gray-700 text-center">Nilai</th>
                            <th class="px-6 py-4 font-semibold text-gray-700">Catatan Sistem / Guru</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($assignments as $assignment)
                            @php $submission = $assignment->submissions->first(); @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $assignment->title }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-xl font-bold text-blue-600">{{ $submission->score }}</span>
                                </td>
                                <td class="px-6 py-4 text-gray-500 text-sm italic">
                                    {{ $submission->teacher_notes ?? 'Tidak ada catatan.' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-gray-400 italic">
                                    Belum ada nilai tugas pilihan ganda yang masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
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