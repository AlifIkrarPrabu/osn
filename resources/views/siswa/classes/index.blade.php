@extends('layouts.app', ['title' => 'My Classes'])

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Kelas Saya</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($myClasses as $class)
            <div class="bg-white border rounded-xl p-5 shadow-sm hover:shadow-md transition">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-3 bg-blue-100 text-blue-600 rounded-lg">
                        <span>🏫</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-800">{{ $class->name }}</h3>
                        <p class="text-xs text-gray-500">
                            Terdaftar: {{ $class->pivot->created_at?->format('d M Y') ?? 'Baru' }}
                        </p>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <div class="flex justify-between text-sm mb-4 text-gray-600">
                        <span>Materi Tersedia</span>
                        <span class="font-bold">{{ $class->materials->count() }}</span>
                    </div>
                    <a href="{{ route('siswa.materials.index', ['class_id' => $class->id]) }}" 
                       class="block w-full text-center py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                        Buka Materi
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center bg-gray-50 border-2 border-dashed rounded-xl">
                <p class="text-gray-400">Anda belum terdaftar di kelas manapun.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection