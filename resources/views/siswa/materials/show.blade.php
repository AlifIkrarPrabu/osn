@extends('layouts.simple')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-2">{{ $material->title }}</h1>
    <p class="text-gray-600 mb-6">{{ $material->description }}</p>

    {{-- 🔒 NOTIFIKASI TERKUNCI --}}
    @if($isLocked)
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded mb-4">
            🔒 Jawaban sudah dikirim. Soal telah terkunci.
        </div>
    @endif

    {{-- FORM --}}
    <form method="POST" action="{{ route('siswa.tasks.answer') }}">
        @csrf

        @foreach($material->tasks as $task)
            <div class="border rounded-lg p-4 mb-4 {{ $isLocked ? 'opacity-60' : '' }}">
                <p class="font-semibold mb-2">
                    {{ $loop->iteration }}. {{ $task->question }}
                </p>

                <input type="hidden" name="tasks[{{ $task->id }}][task_id]" value="{{ $task->id }}">

                {{-- PILIHAN GANDA --}}
                @if($task->type === 'multiple_choice')
                    @foreach(['a','b','c','d'] as $opt)
                        @php $field = 'option_'.$opt; @endphp
                        @if($task->$field)
                            <label class="block mb-1">
                                <input
                                    type="radio"
                                    name="tasks[{{ $task->id }}][answer]"
                                    value="{{ $task->$field }}"
                                    {{ $isLocked ? 'disabled' : 'required' }}
                                >
                                {{ strtoupper($opt) }}. {{ $task->$field }}
                            </label>
                        @endif
                    @endforeach
                @endif

                {{-- ESSAY --}}
                @if($task->type === 'essay')
                    <textarea
                        name="tasks[{{ $task->id }}][answer]"
                        rows="4"
                        class="w-full border rounded p-2"
                        placeholder="Tulis jawaban Anda..."
                        {{ $isLocked ? 'disabled' : 'required' }}
                    ></textarea>
                @endif
            </div>
        @endforeach

        {{-- 🔥 TOMBOL SUBMIT HANYA JIKA BELUM TERKUNCI --}}
        @unless($isLocked)
            <div class="text-right mt-6">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    Kirim Semua Jawaban
                </button>
            </div>
        @endunless

    </form>

</div>
@endsection
