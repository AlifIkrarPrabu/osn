@extends('layouts.app', ['title' => 'Edit Tugas'])

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('guru.assignments.index') }}" class="text-blue-600 hover:underline">← Kembali</a>
        <h1 class="text-3xl font-bold text-gray-800 mt-2">Edit Tugas</h1>
    </div>

    <div class="bg-white border rounded-xl shadow-sm p-6">
        <form action="{{ route('guru.assignments.update', $assignment->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold mb-1">Judul Tugas</label>
                    <input type="text" name="title" value="{{ $assignment->title }}" class="w-full border rounded-lg px-4 py-2" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Target Kelas</label>
                    <select name="classroom_id" class="w-full border rounded-lg px-4 py-2" required>
                        @foreach($classrooms as $class)
                            <option value="{{ $class->id }}" {{ $assignment->classroom_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Instruksi</label>
                    <textarea name="description" rows="4" class="w-full border rounded-lg px-4 py-2" required>{{ $assignment->description }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Deadline</label>
                    <input type="datetime-local" name="deadline" value="{{ $assignment->deadline->format('Y-m-d\TH:i') }}" class="w-full border rounded-lg px-4 py-2" required>
                </div>
            </div>

            <div class="mt-8 border-t pt-6">
                <h2 class="text-xl font-bold mb-4">Daftar Soal</h2>
                <div id="question-container" class="space-y-6">
                    @foreach($assignment->questions as $index => $q)
                    <div class="p-4 border rounded-lg bg-gray-50">
                        <div class="mb-3">
                            <label class="block text-sm font-bold">Pertanyaan {{ $index + 1 }}</label>
                            <input type="text" name="questions[{{ $index }}][text]" value="{{ $q->question_text }}" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="questions[{{ $index }}][a]" value="{{ $q->option_a }}" placeholder="A" class="border rounded px-3 py-1" required>
                            <input type="text" name="questions[{{ $index }}][b]" value="{{ $q->option_b }}" placeholder="B" class="border rounded px-3 py-1" required>
                            <input type="text" name="questions[{{ $index }}][c]" value="{{ $q->option_c }}" placeholder="C" class="border rounded px-3 py-1" required>
                            <input type="text" name="questions[{{ $index }}][d]" value="{{ $q->option_d }}" placeholder="D" class="border rounded px-3 py-1" required>
                        </div>
                        <div class="mt-2">
                            <label class="text-sm font-semibold text-green-700">Jawaban Benar:</label>
                            <select name="questions[{{ $index }}][correct]" class="border rounded ml-2">
                                <option value="a" {{ $q->correct_answer == 'a' ? 'selected' : '' }}>A</option>
                                <option value="b" {{ $q->correct_answer == 'b' ? 'selected' : '' }}>B</option>
                                <option value="c" {{ $q->correct_answer == 'c' ? 'selected' : '' }}>C</option>
                                <option value="d" {{ $q->correct_answer == 'd' ? 'selected' : '' }}>D</option>
                            </select>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="w-full mt-8 bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection