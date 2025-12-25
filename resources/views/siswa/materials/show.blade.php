@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-4">
        {{ $material->title }}
    </h1>

    <p class="mb-6 text-gray-600">
        {{ $material->description }}
    </p>

    <h2 class="text-xl font-semibold mb-3">Soal</h2>

    @forelse ($material->tasks as $task)
        <div class="border p-4 rounded mb-4">
            <p class="font-medium mb-2">
                {{ $task->question }}
            </p>

            @if ($task->type === 'multiple_choice')
                <ul class="list-disc ml-6">
                    <li>A. {{ $task->option_a }}</li>
                    <li>B. {{ $task->option_b }}</li>
                    <li>C. {{ $task->option_c }}</li>
                    <li>D. {{ $task->option_d }}</li>
                </ul>
            @else
                <textarea class="w-full border rounded p-2"
                          placeholder="Jawaban kamu..."></textarea>
            @endif
        </div>
    @empty
        <p class="text-gray-500">Belum ada soal.</p>
    @endforelse

</div>

@endsection
