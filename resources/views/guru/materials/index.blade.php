@extends('layouts.app', ['title' => 'Materi'])

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


    {{-- =========================== --}}
    {{-- KONTEN KANAN --}}
    {{-- =========================== --}}
    <div class="flex-1 ml-0 lg:ml-0 p-6">

        <div class="flex justify-between mb-4">
            <h1 class="text-xl font-semibold">Daftar Materi</h1>

            <a href="{{ route('guru.materials.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                + Tambah Materi
            </a>
        </div>

        <div class="bg-white border rounded-lg p-4">

            @forelse ($materials as $material)
            <div class="border-b py-3 flex justify-between items-center">

                <a href="{{ route('guru.materials.show', $material->id) }}" class="flex-1">
                    <h2 class="font-semibold text-lg">{{ $material->title }}</h2>
                    <p class="text-sm text-gray-600">{{ $material->description ?? '-' }}</p>
                </a>

                <div class="flex items-center gap-2">

                    {{-- BTN EDIT --}}
                    <button 
                        class="px-3 py-1 bg-yellow-500 text-white rounded-lg editBtn"
                        data-id="{{ $material->id }}"
                        data-title="{{ $material->title }}"
                        data-description="{{ $material->description }}"
                        data-duration="{{ $material->duration }}">
                        Edit
                    </button>

                    {{-- BTN HAPUS --}}
                    <form action="{{ route('guru.materials.destroy', $material->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus materi?')">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-1 bg-red-600 text-white rounded-lg">
                            Hapus
                        </button>
                    </form>

                    <a href="{{ route('guru.materials.report', $material->id) }}" 
                        class="text-green-600 hover:text-green-900 mr-3 font-semibold hover:underline">
                        Laporan Nilai
                    </a>

                </div>

            </div>
        @empty

                <p class="text-gray-500">Belum ada materi</p>
            @endforelse

        </div>

    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const modal = document.getElementById("editModal");
    const closeModal = document.getElementById("closeModal");

    // ❗ SHOW MODAL
    document.querySelectorAll(".editBtn").forEach(btn => {
        btn.addEventListener("click", function() {
            document.getElementById("editId").value = this.dataset.id;
            document.getElementById("editTitle").value = this.dataset.title;
            document.getElementById("editDescription").value = this.dataset.description;
            document.getElementById("editDuration").value = this.dataset.duration;

            modal.classList.remove("hidden");
            modal.classList.add("flex");
        });
    });

    // ❗ CLOSE MODAL
    closeModal.addEventListener("click", function () {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    });

    // ❗ SAVE AJAX UPDATE
    document.getElementById("saveEdit").addEventListener("click", function () {
        const id = document.getElementById("editId").value;
        const title = document.getElementById("editTitle").value;
        const description = document.getElementById("editDescription").value;
        const duration = document.getElementById("editDuration").value;
        const saveBtn = this;

        // Loading state
        saveBtn.disabled = true;
        saveBtn.innerText = "Menyimpan...";

        fetch(`/guru/materials/${id}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json", // Penting agar Laravel tahu ini minta JSON
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ 
                _method: 'PATCH', // Laravel akan membaca ini sebagai PATCH
                title: title, 
                description: description, 
                duration: duration 
            })
        })
        
        .then(async res => {
            const data = await res.json();
            if (!res.ok) {
                // Jika error validasi (422) atau error lainnya
                throw new Error(data.message || "Terjadi kesalahan pada server");
            }
            return data;
        })
        .then(data => {
            if (data.success) {
                // Tutup modal dan reload
                location.reload(); 
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Gagal menyimpan: " + error.message);
        })
        .finally(() => {
            saveBtn.disabled = false;
            saveBtn.innerText = "Simpan";
        });
    });

});
</script>

@endsection
