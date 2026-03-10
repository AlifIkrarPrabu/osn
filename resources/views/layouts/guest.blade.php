<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased m-0 p-0">
        {{-- 
            PERBAIKAN:
            1. Menghapus 'pt-6' dan 'bg-gray-100' agar tidak ada jarak dan warna abu-abu di atas.
            2. Menggunakan 'w-full' dan 'min-h-screen' tanpa padding tambahan.
        --}}
        <div class="min-h-screen w-full">
            {{-- 
                PERBAIKAN:
                Menghapus 'mt-6' agar $slot (konten register) benar-benar mulai dari koordinat 0 (paling atas).
            --}}
            <div class="w-full">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>