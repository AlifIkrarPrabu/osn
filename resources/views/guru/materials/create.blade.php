@extends('layouts.app', ['title' => 'Tambah Materi'])

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

<div class="flex-1 ml-0 lg:ml-0 p-6">

    <h1 class="text-xl font-semibold mb-4">Tambah Materi</h1>

    <form method="POST" action="{{ route('guru.materials.store') }}">
        @csrf

        <div class="mb-3">
            <label class="font-semibold">Judul Materi</label>
            <input type="text" name="title" class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="font-semibold">Deskripsi</label>
            <textarea name="description" class="w-full border p-2 rounded"></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Waktu Ujian (menit)</label>
            <input type="number"
                name="duration"
                min="1"
                required
                class="w-full border rounded p-2"
                placeholder="Contoh: 20">
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">
            Simpan
        </button>

    </form>

</div>

@endsection
