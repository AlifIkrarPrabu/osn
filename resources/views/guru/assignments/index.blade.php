@extends('layouts.app', ['title' => 'Manajemen Tugas'])

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

    <!-- MODAL EDIT -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg w-96">

        <h2 class="text-xl font-semibold mb-4">Edit Materi</h2>

        <input type="hidden" id="editId">

        <label class="block mb-2">Judul</label>
        <input id="editTitle" class="w-full border p-2 rounded mb-3">

        <label class="block mb-2">Deskripsi</label>
        <textarea id="editDescription" class="w-full border p-2 rounded mb-4"></textarea>

        <label class="block mb-2">Durasi (Menit)</label>
        <input type="number" id="editDuration" class="w-full border p-2 rounded mb-4">

        <div class="flex justify-end gap-2">
            <button id="closeModal" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
            <button id="saveEdit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
        </div>

    </div>
</div>
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Daftar Tugas</h1>
            <p class="text-gray-500">Kelola tugas dan pantau pengumpulan siswa.</p>
        </div>
        <a href="{{ route('guru.assignments.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition">
            + Buat Tugas Baru
        </a>
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
                    <th class="px-6 py-4 font-semibold text-gray-700">Judul Tugas</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Kelas</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Deadline</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($assignments as $assignment)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $assignment->title }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $assignment->classroom->name }}</td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $assignment->deadline->format('d M Y, H:i') }}
                    </td>
                    <td class="px-6 py-4">
                        @if($assignment->deadline->isPast())
                            <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full font-bold">Ditutup</span>
                        @else
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-bold">Aktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 flex justify-center gap-3">
                        <a href="{{ route('guru.assignments.show', $assignment->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                            Pantau
                        </a>
                        <a href="{{ route('guru.assignments.edit', $assignment->id) }}" class="text-yellow-600 hover:text-yellow-800 font-semibold text-sm">
                            Edit
                        </a>
                        <form action="{{ route('guru.assignments.destroy', $assignment->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tugas ini? Semua jawaban siswa juga akan terhapus.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-500 italic">
                        Belum ada tugas yang dibuat.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection