@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">Edit Materi</h2>
            <a href="{{ auth()->user()->role === 'admin' ? route('admin.materials.index') : route('guru.materials.index') }}" class="text-gray-500 hover:text-gray-700 font-medium text-sm">
                &larr; Kembali
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form action="{{ auth()->user()->role === 'admin' ? route('admin.materials.update', $material->id) : route('guru.materials.update', $material->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <!-- Judul -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Materi</label>
                    <input type="text" name="title" value="{{ old('title', $material->title) }}" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Materi</label>
                    <textarea name="description" rows="5" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 shadow-sm">{{ old('description', $material->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Durasi (Jika ada di database Anda) -->
                <div class="mb-8">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Durasi Pengerjaan (Menit)</label>
                    <input type="number" name="duration" value="{{ old('duration', $material->duration) }}" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
                    @error('duration') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-blue-100">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection