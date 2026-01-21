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

    {{-- TIMER --}}
    <div class="bg-red-50 border border-red-300 p-4 rounded mb-6 text-center">
        <p class="font-semibold text-red-700">
            Sisa Waktu:
            <span id="timer" class="text-xl font-bold"></span>
        </p>
    </div>

    {{-- FORM --}}
    <form method="POST"
          id="examForm"
          action="{{ route('siswa.answers.store', $material->id) }}">
        @csrf

        @foreach ($material->tasks as $task)
            <div class="border p-4 rounded mb-4">
                <p class="font-medium mb-2">{{ $task->question }}</p>

                @if ($task->type === 'multiple_choice')
                    @foreach (['a','b','c','d'] as $opt)
                        <label class="block">
                            <input type="radio"
                                   name="answers[{{ $task->id }}]"
                                   value="{{ $opt }}"
                                   {{ ($answers[$task->id] ?? null) === $opt ? 'checked' : '' }}
                                   {{ $isLocked ? 'disabled' : '' }}>
                            {{ strtoupper($opt) }}.
                            {{ $task->{'option_'.$opt} }}
                        </label>
                    @endforeach
                @else
                    <textarea name="answers[{{ $task->id }}]"
                              class="w-full border rounded p-2"
                              {{ $isLocked ? 'disabled' : '' }}>{{ $answers[$task->id] ?? '' }}</textarea>
                @endif
            </div>
        @endforeach

        @if (!$isLocked)
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded"
                    id="submitBtn">
                Kirim Semua Jawaban
            </button>
        @else
            <p class="text-center text-red-600 font-semibold">
                ⛔ Waktu ujian telah berakhir
            </p>
        @endif
    </form>

</div>

{{-- SCRIPT TIMER --}}
@if (!$isLocked)
<script>
let remaining = Math.floor({{ $remainingSeconds }});
const timerEl = document.getElementById('timer');
const form = document.getElementById('examForm');

const interval = setInterval(() => {
    let minutes = Math.floor(remaining / 60);
    let seconds = remaining % 60;

    timerEl.innerText =
        minutes + ':' + (seconds < 10 ? '0' : '') + seconds;

    if (remaining <= 0) {
        clearInterval(interval);
        form.submit(); // AUTO SUBMIT
    }

    remaining--;
}, 1000);
</script>
@else
<script>
document.getElementById('timer').innerText = '00:00';
</script>
@endif
@endsection
