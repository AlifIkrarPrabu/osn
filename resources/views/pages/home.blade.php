@extends('layouts.app', ['title' => 'LMS - OSN'])

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
    
    {{-- ================================================= --}}
    {{-- BAGIAN 1: INFORMASI OSN (Menggantikan Hero Section) --}}
    {{-- ================================================= --}}
    <div class="flex flex-col lg:flex-row items-center justify-between gap-12 pt-8 pb-16">
        
        {{-- Kiri: Teks dan Deskripsi OSN --}}
        <div class="lg:w-1/2 text-center lg:text-left">
            <h1 class="text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                Olimpiade Sains <br class="hidden sm:inline"> Nasional
            </h1>
            <p class="text-lg text-gray-700 mb-8 max-w-xl mx-auto lg:mx-0">
                OSN adalah singkatan dari Olimpiade Sains Nasional, sebuah kompetisi sains tingkat nasional 
                bagi siswa SD, SMP, dan SMA di Indonesia yang diselenggarakan oleh Pusat Prestasi Nasional 
                (Puspresnas). OSN bertujuan untuk menjaring talenta sains unggul dari seluruh Indonesia untuk 
                dikembangkan dan dipersiapkan mewakili Indonesia di olimpiade sains internasional. 
            </p>
            
            {{-- Tombol Aksi - Diubah menjadi pendaftaran/informasi resmi --}}
            <a href="https://pusatprestasinasional.kemdikbud.go.id/osn/" target="_blank" 
               class="inline-block px-8 py-3 text-lg bg-pink-600 text-white font-bold rounded-xl shadow-lg 
                      hover:bg-pink-700 transition duration-300 transform hover:scale-105">
                Cek Informasi Resmi OSN
            </a>
        </div>
        
        {{-- Kanan: Ilustrasi (Placeholder) --}}
        <div class="lg:w-1/2 flex justify-center lg:justify-end">
            <img src="{{ asset('assets/images/osn.jpg') }}" 
                alt="Ilustrasi OSN" 
                class="rounded-xl shadow-2xl w-96 h-auto">
</div>
    </div>
    
    
    {{-- ================================================= --}}
    {{-- BAGIAN 2: BIDANG SAINS OSN (Dihapus semua referensi materi/kursus) --}}
    {{-- ================================================= --}}
    <div class="mt-24">
        <div class="text-center mb-16">
            <span class="text-sm font-semibold uppercase tracking-wider text-indigo-600">
                Bidang Lomba
            </span>
            <h2 class="text-4xl font-extrabold text-gray-900 mt-2">
                Bidang yang Dilombakan pada OSN SMA/MA
            </h2>
            <p class="text-lg text-gray-500 mt-4">
                Ada 9 bidang lomba yang dipertandingkan dalam Olimpiade Sains Nasional.
            </p>
        </div>

        {{-- Grid untuk 9 Bidang (Disalin dari kode sebelumnya) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">

            @php
                $bidangs = [
                    ['nama' => 'Matematika', 'icon' => '➗', 'color' => 'red'],
                    ['nama' => 'Fisika', 'icon' => '⚛️', 'color' => 'blue'],
                    ['nama' => 'Kimia', 'icon' => '🧪', 'color' => 'green'],
                    ['nama' => 'Informatika', 'icon' => '💻', 'color' => 'yellow'],
                    ['nama' => 'Biologi', 'icon' => '🌿', 'color' => 'teal'],
                    ['nama' => 'Astronomi', 'icon' => '🪐', 'color' => 'purple'],
                    ['nama' => 'Kebumian', 'icon' => '🌍', 'color' => 'orange'],
                    ['nama' => 'Ekonomi', 'icon' => '📈', 'color' => 'pink'],
                    ['nama' => 'Geografi', 'icon' => '🗺️', 'color' => 'indigo'],
                ];
            @endphp
            
            @foreach ($bidangs as $bidang)
                @php
                    $ringColor = 'ring-'.$bidang['color'].'-500';
                    $hoverBgColor = 'hover:bg-'.$bidang['color'].'-50';
                    $textColor = 'text-'.$bidang['color'].'-600';
                @endphp
                
                {{-- Kartu Bidang --}}
                <a href="#" class="block p-6 bg-white rounded-xl shadow-lg 
                                  border border-gray-100 transform transition duration-300 
                                  hover:scale-[1.03] {{ $hoverBgColor }} hover:shadow-2xl 
                                  group">
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto mb-4 flex items-center justify-center 
                                    text-5xl border-4 {{ $ringColor }} rounded-full 
                                    bg-gray-50 group-hover:bg-white transition duration-300">
                            {{ $bidang['icon'] }}
                        </div>

                        <h3 class="text-xl font-bold mb-2 text-gray-800 group-hover:{{ $textColor }} transition duration-300">
                            {{ $bidang['nama'] }}
                        </h3>
                        
                        {{-- Tautan Aksi diubah menjadi "Cek Detail" --}}
                        <p class="text-sm font-semibold {{ $textColor }} mt-4 flex items-center justify-center">
                            Cek Detail Bidang
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </p>
                    </div>
                </a>
            @endforeach

        </div>
        
        {{-- Tombol CTA Lebih Lanjut (Dihapus referensi kursus/materi) --}}
        <div class="text-center mt-12">
            <a href="#" class="inline-block px-8 py-3 text-lg bg-indigo-600 text-white font-bold rounded-full shadow-xl 
                                hover:bg-indigo-700 transition duration-300 transform hover:scale-105">
                Lihat Persyaratan Lomba
            </a>
        </div>
    </div>
    
</div>
@endsection