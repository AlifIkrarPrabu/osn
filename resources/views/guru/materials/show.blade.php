@extends('layouts.app', ['title' => $material->title])

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
<aside id="sidebar"
    class="bg-white border-r w-64 min-h-screen py-8 px-5 p-5 space-y-4 
           fixed lg:static inset-y-0 left-0 z-40 transform -translate-x-full 
           lg:translate-x-0 transition-transform duration-300">

    <h1 class="text-xl font-bold mb-6">Logo</h1>

    {{-- MENU LIST --}}
    <nav class="space-y-2 mt-4">

        {{-- DASHBOARD (ACTIVE) --}}
        <a href="{{ url('/guru/dashboard') }}"
            class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
            <span>📊</span> Dashboard
        </a>

        <a href="{{ url('/guru/students') }}"
            class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
            <span>👥</span> Students
        </a>

        <a href="{{ url('/guru/materials') }}" 
            class="flex items-center gap-2 px-3 py-2 rounded-lg 
                   border border-blue-500 bg-blue-50 text-blue-600 font-semibold">
            <span>📄</span> Materi
        </a>

        <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
            <span>📝</span> Assignments
        </a>

        <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
            <span>🎓</span> Grades
        </a>

        <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
            <span>💬</span> Discussions
        </a>

        <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
            <span>📅</span> Calendar
        </a>

        <a href="#" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-100 rounded-lg">
            <span>📢</span> Announcement
        </a>

    </nav>
</aside>


    {{-- OVERLAY (MOBILE ONLY) --}}
    <div id="overlay"
        class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 lg:hidden">
    </div>

<div class="max-w-4xl w-full mx-auto py-6">

    <h1 class="text-2xl font-semibold mb-2">{{ $material->title }}</h1>
    <p class="text-gray-600 mb-6">{{ $material->description }}</p>

    {{-- ================================ --}}
    {{-- FORM TAMBAH TUGAS --}}
    {{-- ================================ --}}
    <div class="bg-white p-4 border rounded-lg mb-6 w-full">
        <h2 class="font-semibold mb-3">Tambah Tugas</h2>

        <form action="{{ route('guru.tasks.store', $material->id) }}" method="POST">
            @csrf

            <label class="block mb-1 font-medium">Jenis Tugas</label>
            <select name="type" id="task-type" class="border p-2 rounded w-full mb-3">
                <option value="multiple_choice">Pilihan Ganda</option>
                <option value="essay">Essay</option>
            </select>

            <label class="block mb-1 font-medium">Pertanyaan</label>
            <textarea name="question" class="border p-2 rounded w-full mb-3" required></textarea>

            {{-- Form Pilihan Ganda --}}
            <div id="mcq-fields">
                <input type="text" name="option_a" placeholder="Opsi A" class="border p-2 rounded w-full mb-2">
                <input type="text" name="option_b" placeholder="Opsi B" class="border p-2 rounded w-full mb-2">
                <input type="text" name="option_c" placeholder="Opsi C" class="border p-2 rounded w-full mb-2">
                <input type="text" name="option_d" placeholder="Opsi D" class="border p-2 rounded w-full mb-2">

                <label class="block mb-1 font-medium">Jawaban Benar</label>
                <select name="correct_answer" class="border p-2 rounded w-full mb-3">
                    <option value="">-- Pilih Jawaban --</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Simpan Tugas
            </button>

        </form>
    </div>

    {{-- ================================ --}}
    {{-- LIST TUGAS --}}
    {{-- ================================ --}}
    <div class="bg-white p-4 border rounded-lg">
        <h2 class="font-semibold mb-3">Daftar Tugas</h2>

        @foreach ($material->tasks as $task)
        <div class="border-b py-3">

            <p class="font-bold text-lg">Soal {{ $loop->iteration }}</p>
            <p class="text-sm font-semibold text-blue-600">{{ strtoupper($task->type) }}</p>
            <p>{{ $task->question }}</p>

            @if($task->type === 'multiple_choice')
                <ul class="mt-2 text-gray-700 text-sm">
                    <li>A. {{ $task->option_a }}</li>
                    <li>B. {{ $task->option_b }}</li>
                    <li>C. {{ $task->option_c }}</li>
                    <li>D. {{ $task->option_d }}</li>
                    <li class="mt-1 text-green-600 font-semibold">
                        Jawaban Benar: {{ $task->correct_answer }}
                    </li>
                </ul>
            @endif

            {{-- BUTTON --}}
            <div class="mt-3 flex gap-2">
                <button 
                    onclick="openEditModal({{ $task }})"
                    class="px-3 py-1 bg-yellow-500 text-white rounded">
                    Edit
                </button>

                <button onclick="deleteTask({{ $task->id }})"
                    class="px-3 py-1 bg-red-500 text-white rounded">
                    Hapus
                </button>
            </div>

        </div>
        @endforeach
    </div>
    

</div>

<!-- MODAL EDIT -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-lg">

        <h2 class="font-semibold mb-3">Edit Soal</h2>

        <form id="editForm">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit-task-id">

            <label>Jenis</label>
            <select id="edit-type" class="border p-2 w-full mb-2">
                <option value="multiple_choice">Pilihan Ganda</option>
                <option value="essay">Essay</option>
            </select>

            <label>Pertanyaan</label>
            <textarea id="edit-question" class="border p-2 w-full mb-2"></textarea>

            <div id="edit-mcq-fields">
                <label>A</label><input id="edit-a" class="border p-2 w-full mb-2" placeholder="Opsi A">
                <label>B</label><input id="edit-b" class="border p-2 w-full mb-2" placeholder="Opsi B">
                <label>C</label><input id="edit-c" class="border p-2 w-full mb-2" placeholder="Opsi C">
                <label>D</label><input id="edit-d" class="border p-2 w-full mb-2" placeholder="Opsi D">

                <label>Jawaban Benar</label>
                <select id="edit-correct" class="border p-2 w-full mb-2">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeEditModal()" class="px-3 py-1 border rounded">Batal</button>
                <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>

    </div>
</div>

{{-- Script untuk hide/unhide form pilihan ganda --}}
<script>
    const typeSelect = document.getElementById('task-type');
    const mcqFields = document.getElementById('mcq-fields');

    function toggleFields() {
        if (typeSelect.value === 'essay') {
            mcqFields.style.display = 'none';
        } else {
            mcqFields.style.display = 'block';
        }
    }

    typeSelect.addEventListener('change', toggleFields);

    // Run on page load
    toggleFields();
</script>

{{-- Script untuk edit modal --}}
<script>
let editModal = document.getElementById('editModal');

function openEditModal(task) {
    document.getElementById('edit-task-id').value = task.id;
    document.getElementById('edit-type').value = task.type;
    document.getElementById('edit-question').value = task.question;

    document.getElementById('edit-a').value = task.option_a ?? '';
    document.getElementById('edit-b').value = task.option_b ?? '';
    document.getElementById('edit-c').value = task.option_c ?? '';
    document.getElementById('edit-d').value = task.option_d ?? '';
    document.getElementById('edit-correct').value = task.correct_answer ?? '';

    toggleEditFields();
    editModal.classList.remove('hidden');
}

function closeEditModal() {
    editModal.classList.add('hidden');
}

function toggleEditFields() {
    let type = document.getElementById('edit-type').value;
    let mcq = document.getElementById('edit-mcq-fields');
    mcq.style.display = type === 'essay' ? 'none' : 'block';
}

document.getElementById('edit-type').addEventListener('change', toggleEditFields);

document.getElementById('editForm').addEventListener('submit', function(e){
    e.preventDefault();

    let id = document.getElementById('edit-task-id').value;

    fetch(`/guru/tasks/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            _method: 'PUT',
            type: document.getElementById('edit-type').value,
            question: document.getElementById('edit-question').value,
            option_a: document.getElementById('edit-a').value,
            option_b: document.getElementById('edit-b').value,
            option_c: document.getElementById('edit-c').value,
            option_d: document.getElementById('edit-d').value,
            correct_answer: document.getElementById('edit-correct').value,
        })
    }).then(res => res.json())
      .then(data => location.reload());
});

function deleteTask(id) {
    if (!confirm('Yakin ingin menghapus soal ini?')) return;

    fetch(`/guru/tasks/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        location.reload();
    });
}
</script>
@endsection
