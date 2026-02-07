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

        @foreach ($material->tasks as $index => $task)
            <div class="bg-white border p-6 rounded-lg shadow-sm mb-6">
                <div class="flex items-start mb-4">
                    <span class="bg-blue-100 text-blue-800 text-sm font-bold px-3 py-1 rounded-full mr-3">
                        {{ $index + 1 }}
                    </span>
                    <p class="font-semibold text-gray-800 text-lg">{{ $task->question }}</p>
                </div>

                @if ($task->type === 'multiple_choice')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 ml-10">
                        @foreach (['a','b','c','d'] as $opt)
                            @php
                                $isChecked = ($answers[$task->id] ?? null) === $opt;
                            @endphp
                            <label class="relative flex items-center p-3 border rounded-xl cursor-pointer transition-all hover:bg-gray-50 {{ $isChecked ? 'bg-blue-50 border-blue-400 ring-1 ring-blue-400' : 'border-gray-200' }}">
                                <input type="radio"
                                       name="answers[{{ $task->id }}]"
                                       value="{{ $opt }}"
                                       class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                       {{ $isChecked ? 'checked' : '' }}
                                       {{ $isLocked ? 'disabled' : '' }}>
                                <span class="ml-3 text-gray-700">
                                    <span class="font-bold mr-1">{{ strtoupper($opt) }}.</span> 
                                    {{ $task->{'option_'.$opt} }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                @else
                    <div class="ml-10">
                        <textarea name="answers[{{ $task->id }}]"
                                  rows="4"
                                  placeholder="Tuliskan jawaban Anda di sini..."
                                  class="w-full border-gray-300 rounded-xl p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500 {{ $isLocked ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                  {{ $isLocked ? 'disabled' : '' }}>{{ $answers[$task->id] ?? '' }}</textarea>
                    </div>
                @endif
            </div>
        @endforeach

        <div class="mt-8 p-4 bg-gray-50 rounded-lg border border-dashed border-gray-300 flex justify-center">
            @if (!$isLocked)
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-10 py-3 rounded-full shadow-lg transform transition active:scale-95"
                        id="submitBtn">
                    Submit Semua Jawaban
                </button>
            @else
                <div class="flex items-center text-red-600 bg-red-50 px-6 py-3 rounded-full border border-red-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-bold">Waktu ujian telah berakhir. Jawaban tidak dapat diubah lagi.</span>
                </div>
            @endif
        </div>
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
