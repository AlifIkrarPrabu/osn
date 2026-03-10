@extends('layouts.app', ['title' => 'Exam SOC | Pelatihan OSN dan Kompetisi Sains SOC'])

@section('content')
<div class="bg-gray-50 font-sans text-gray-900">

    {{-- HERO SECTION --}}
    <section class="relative bg-white pt-16 pb-24 overflow-hidden">
        <div class="container mx-auto px-4 lg:px-20">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                {{-- Kiri: Konten Teks --}}
                <div class="lg:w-1/2 z-10 text-center lg:text-left">
                    <h2 class="text-blue-600 font-bold text-2xl lg:text-3xl mb-2">Selamat Datang di</h2>
                    <h1 class="text-4xl lg:text-5xl font-extrabold text-blue-900 leading-tight mb-6">
                        LMS OSN SOC Indonesia
                    </h1>
                    <p class="text-gray-600 text-lg mb-2 max-w-lg mx-auto lg:mx-0">
                        Platform belajar untuk persiapan 
                    </p>
                    <p class="text-gray-600 text-lg mb-8 max-w-lg mx-auto lg:mx-0">
                        Olimpiade Sains Nasional.
                    </p>
                    <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-lg shadow-lg hover:bg-blue-700 transition transform hover:-translate-y-1">
                            Mulai Belajar Yuk
                        </a>
                        <a href="www.pelatihanosn-soc.com" class="px-8 py-3 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition">
                            Info Lebih Lanjut
                        </a>
                    </div>
                </div>

                {{-- Kanan: Ilustrasi --}}
                <div class="lg:w-1/2 relative flex justify-center">
                    <div class="absolute -top-10 -right-10 w-72 h-72 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
                    <img src="{{ asset('assets/images/ilustrasi.png') }}" 
                         alt="[Ilustrasi Siswa Belajar]" 
                         class="relative z-10 w-full h-auto max-w-md drop-shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    {{-- FEATURES SECTION (KARTU FITUR) --}}
    <section class="py-12 -mt-12 relative z-20">
        <div class="container mx-auto px-4 lg:px-20">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                {{-- Kartu 1: Latihan Soal (IKON TERBARU) --}}
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 text-center hover:shadow-2xl transition group transform hover:-translate-y-1">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-600 transition duration-300">
                        {{-- Ikon Document Text --}}
                        <svg class="w-8 h-8 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-blue-900 group-hover:text-blue-600 transition">Latihan Soal</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Ribuan soal latihan untuk semua bidang OSN.</p>
                </div>

                {{-- Kartu 2: Simulasi Ujian --}}
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 text-center hover:shadow-2xl transition group transform hover:-translate-y-1">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-500 transition duration-300">
                        {{-- Ikon Cursor Click --}}
                        <svg class="w-8 h-8 text-blue-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-blue-900 group-hover:text-blue-500 transition">Simulasi Ujian</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Ujian tryout online seperti OSN sesungguhnya.</p>
                </div>

                {{-- Kartu 3: Materi Pembelajaran --}}
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 text-center hover:shadow-2xl transition group transform hover:-translate-y-1">
                    <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-green-500 transition duration-300">
                        {{-- Ikon Book Open --}}
                        <svg class="w-8 h-8 text-green-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.168.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-blue-900 group-hover:text-green-600 transition">Materi Pembelajaran</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Video & modul lengkap untuk belajar efektif.</p>
                </div>

                {{-- Kartu 4: Pantau Progress --}}
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 text-center hover:shadow-2xl transition group transform hover:-translate-y-1">
                    <div class="w-16 h-16 bg-orange-50 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-orange-500 transition duration-300">
                        {{-- Ikon Chart Bar --}}
                        <svg class="w-8 h-8 text-orange-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-blue-900 group-hover:text-orange-600 transition">Pantau Progres</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Lihat perkembangan dan nilai kamu secara berkala.</p>
                </div>

            </div>
        </div>
    </section>

    {{-- KENAPA MEMILIH SECTION --}}
    <section id="kenapa-kami" class="py-24 bg-white">
        <div class="container mx-auto px-4 lg:px-20 text-center">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-blue-900 mb-4">Kenapa Memilih LMS OSN SOC Indonesia?</h2>
            <div class="w-24 h-1.5 bg-blue-600 mx-auto rounded-full mb-16"></div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-left">
                <div class="flex gap-4 p-6 rounded-xl hover:bg-blue-50 transition">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-blue-900 mb-2">Terpercaya & Resmi</h4>
                        <p class="text-gray-500 text-sm">Platform resmi SOC untuk persiapan OSN yang terstandarisasi.</p>
                    </div>
                </div>

                <div class="flex gap-4 p-6 rounded-xl hover:bg-yellow-50 transition">
                    <div class="flex-shrink-0 w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-blue-900 mb-2">Prestasi Terbaik</h4>
                        <p class="text-gray-500 text-sm"><span class="font-bold text-blue-600">98%</span> Peserta kami lolos ke OSN Tingkat Nasional.</p>
                    </div>
                </div>

                <div class="flex gap-4 p-6 rounded-xl hover:bg-green-50 transition">
                    <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-blue-900 mb-2">Aman & Terlindungi</h4>
                        <p class="text-gray-500 text-sm">Keamanan data pengguna terjamin dengan sistem enkripsi terbaru.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- TESTIMONI SECTION --}}
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 lg:px-20">
            <h2 class="text-center text-3xl font-extrabold text-blue-900 mb-16">Apa Kata Mereka?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="bg-white p-8 rounded-2xl shadow-lg flex gap-6 items-center">
                    <img src="https://ui-avatars.com/api/?name=Rina+A&background=0D8ABC&color=fff" class="w-16 h-16 rounded-full border-4 border-blue-50" alt="[Avatar]">
                    <div>
                        <p class="text-gray-600 italic mb-2">"Belajar di LMS OSN SOC sangat membantu saya meraih medali emas di OSN!."</p>
                        <h5 class="font-bold text-blue-900 text-sm uppercase tracking-wide">Rina A. | <span class="text-blue-500">Peserta 2021</span></h5>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-lg flex gap-6 items-center">
                    <img src="https://ui-avatars.com/api/?name=Budi+S&background=34D399&color=fff" class="w-16 h-16 rounded-full border-4 border-green-50" alt="[Avatar]">
                    <div>
                        <p class="text-gray-600 italic mb-2">"Platform ini sangat bagus dan lengkap untuk melatih siswa saya."</p>
                        <h5 class="font-bold text-blue-900 text-sm uppercase tracking-wide">Pak Budi | <span class="text-green-500">Pembina OSN</span></h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CALL TO ACTION --}}
    <section class="py-20">
        <div class="container mx-auto px-4 lg:px-20">
            <div class="bg-blue-600 rounded-3xl p-10 lg:p-16 text-center text-white shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-32 h-32 bg-white opacity-10 rounded-full -ml-16 -mt-16"></div>
                <h2 class="text-3xl lg:text-4xl font-bold mb-6">Siap Meraih Prestasi di OSN?</h2>
                <p class="text-blue-100 text-lg mb-10 max-w-2xl mx-auto">Bergabunglah bersama ribuan siswa lainnya dan mulai persiapanmu hari ini dengan fasilitas terbaik.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('register') }}" class="px-10 py-4 bg-yellow-400 text-blue-900 font-extrabold rounded-xl hover:bg-yellow-300 transition shadow-lg">
                        Daftar Sekarang
                    </a>
                </div>
                <p class="mt-10 text-sm text-blue-200">Informasi Resmi: <a href="https://www.pelatihanosn-soc.com" class="underline font-bold">www.pelatihanosn-soc.com</a></p>
            </div>
        </div>
    </section>

</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
    .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
    html { scroll-behavior: smooth; }
</style>
@endsection