@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <nav class="text-sm text-gray-500 mb-2">
                    <a href="{{ route('guru.dashboard') }}" class="hover:text-blue-600">Dashboard</a> / 
                    <a href="{{ route('guru.materials.index') }}" class="hover:text-blue-600">Materi</a> / 
                    <span class="text-gray-800">Laporan</span>
                </nav>
                <div class="print-header">
                    <h1 class="text-2xl font-bold uppercase">Laporan Hasil Pengerjaan Siswa</h1>
                    <p class="text-lg">Materi: {{ $material->title }}</p>
                </div>
            </div>
            <div class="flex gap-2">
                <button onclick="window.print()" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 flex items-center gap-2 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak
                </button>
                <a href="{{ route('guru.materials.index') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 shadow-md transition font-medium">
                    Kembali
                </a>
            </div>
        </div>

        <!-- Statistik Singkat -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Total Peserta</p>
                <p class="text-3xl font-bold text-gray-900">{{ $reports->count() }} <span class="text-sm font-normal text-gray-400 italic">Siswa Selesai</span></p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Rata-rata Skor</p>
                <p class="text-3xl font-bold text-blue-600">{{ $reports->avg('score') ?? 0 }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Jumlah Soal PG</p>
                <p class="text-3xl font-bold text-gray-900">{{ $material->tasks->where('type', 'multiple_choice')->count() }}</p>
            </div>
        </div>

        <!-- Tabel Laporan -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Peringkat</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Nama Siswa</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase text-center">Benar</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase text-center">Skor</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Waktu Selesai</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($reports->sortByDesc('score') as $report)
                        <tr class="hover:bg-blue-50/30 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full {{ $loop->iteration <= 3 ? 'bg-yellow-100 text-yellow-700 font-bold' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $loop->iteration }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                {{ $report['student_name'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="text-green-600 font-bold">{{ $report['correct'] }}</span>
                                <span class="text-gray-400">/ {{ $report['total_mc'] }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-3 py-1 rounded-full text-sm font-bold {{ $report['score'] >= 75 ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                                    {{ $report['score'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 italic">
                                @if($report['finished_at'])
                                    {{-- Mengatur timezone ke Asia/Jakarta agar realtime WIB --}}
                                    {{ $report['finished_at']->timezone('Asia/Jakarta')->translatedFormat('d M Y, H:i') }}
                                    <span class="block text-xs text-blue-500 font-medium">
                                        ({{ $report['duration'] }})
                                    </span>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Belum ada data pengerjaan.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection