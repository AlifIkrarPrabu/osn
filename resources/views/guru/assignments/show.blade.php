@extends('layouts.app', ['title' => 'Pantau Tugas'])

@section('content')
<div class="p-6">
    <div class="mb-6">
        <a href="{{ route('guru.assignments.index') }}" class="text-blue-600 hover:underline">← Kembali ke Daftar Tugas</a>
        <h1 class="text-3xl font-bold text-gray-800 mt-2">{{ $assignment->title }}</h1>
        <p class="text-gray-600">Kelas: {{ $assignment->classroom->name }} | Deadline: {{ $assignment->deadline->format('d M Y, H:i') }}</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4 font-semibold text-gray-700">Nama Siswa</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Waktu Kumpul</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Nilai</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($students as $student)
                @php
                    $submission = $student->submissions->first();
                @endphp
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">{{ $student->name }}</td>
                    <td class="px-6 py-4">
                        @if($submission)
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-bold">Sudah Mengumpulkan</span>
                        @else
                            <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full font-bold">Belum Mengumpulkan</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-500">
                        {{ $submission ? $submission->submitted_at->format('d M Y, H:i') : '-' }}
                    </td>
                    <td class="px-6 py-4 font-bold text-blue-600">
                        {{ $submission && $submission->score !== null ? $submission->score : '-' }}
                    </td>
                    <td class="px-6 py-4">
                        @if($submission)
                            <form action="{{ route('guru.submissions.grade', $submission->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <input type="number" name="score" value="{{ $submission->score }}" placeholder="Nilai" class="w-16 border rounded px-2 py-1 text-sm" min="0" max="100">
                                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">Simpan</button>
                            </form>
                        @else
                            <span class="text-gray-400 text-sm italic">N/A</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection