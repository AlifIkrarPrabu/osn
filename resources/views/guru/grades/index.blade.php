@extends('layouts.app', ['title' => 'Rekap Nilai Siswa'])

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
    <h1 class="text-3xl font-bold mb-6">Rekapitulasi Nilai Siswa</h1>

    <div class="bg-white border rounded-xl p-5 shadow-sm mb-8 max-w-md">
        <form action="{{ route('guru.grades.index') }}" method="GET" class="space-y-3">
            <label for="class_id" class="block font-semibold text-gray-700">Pilih Kelas Terlebih Dahulu:</label>
            <div class="flex gap-3">
                <select name="class_id" id="class_id" class="flex-1 border rounded-lg px-3 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($classrooms as $class)
                        <option value="{{ $class->id }}" {{ $selectedClassId == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-600 text-white font-bold px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Buka Rekap
                </button>
            </div>
        </form>
    </div>

    @if($selectedClassId)
        <div class="bg-white border rounded-xl shadow-sm overflow-hidden">
            <div class="p-5 border-b bg-gray-50">
                <h2 class="text-xl font-bold text-gray-800">Buku Nilai Tugas Pilihan Ganda</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-gray-700">Nama Siswa</th>
                            @foreach($assignments as $assignment)
                                <th class="px-6 py-4 font-semibold text-gray-700 text-center" title="{{ $assignment->title }}">
                                    {{ Str::limit($assignment->title, 15) }}
                                </th>
                            @endforeach
                            <th class="px-6 py-4 font-semibold text-gray-700 text-center bg-blue-50 text-blue-800">Rata-Rata</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($students as $student)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $student->name }}</td>
                                
                                @php 
                                    $studentTotalScore = 0; 
                                    $studentTaskCount = 0;
                                @endphp

                                @foreach($assignments as $assignment)
                                    @php 
                                        // Cari nilai siswa untuk tugas spesifik ini
                                        $submission = $student->submissions->where('assignment_id', $assignment->id)->first();
                                        $score = $submission ? $submission->score : null;
                                        
                                        if($score !== null) {
                                            $studentTotalScore += $score;
                                            $studentTaskCount++;
                                        }
                                    @endphp
                                    <td class="px-6 py-4 text-center font-semibold text-gray-600">
                                        {{ $score !== null ? $score : '-' }}
                                    </td>
                                @endforeach

                                <td class="px-6 py-4 text-center font-bold text-blue-600 bg-blue-50/50">
                                    {{ $studentTaskCount > 0 ? round($studentTotalScore / $studentTaskCount) : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $assignments->count() + 2 }}" class="px-6 py-12 text-center text-gray-400 italic">
                                    Belum ada siswa yang bergabung di kelas ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="border-2 border-dashed rounded-xl p-12 text-center bg-white">
            <p class="text-gray-400 italic">Silakan pilih salah satu kelas di atas untuk melihat rangkuman nilai rapor siswa.</p>
        </div>
    @endif
</div>
@endsection