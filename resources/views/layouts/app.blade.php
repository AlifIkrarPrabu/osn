<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js']) 
    </head>
    <body class="font-sans antialiased">
        
        {{-- ============================================= --}}
        {{-- LANGKAH 1: MEMASUKKAN HEADER ANDA DI SINI --}}
        {{-- Ini mengacu ke resources/views/layouts/header.blade.php --}}
        @include('layouts.header') 
        {{-- ============================================= --}}

        <main>
            {{-- LANGKAH 2: INI ADALAH TEMPAT KONTEN HOME/DASHBOARD DIMASUKKAN --}}
            @yield('content') 
        </main>

        {{-- ============================================= --}}
        {{-- LANGKAH 3: MEMASUKKAN FOOTER ANDA DI SINI --}}
        {{-- Ini mengacu ke resources/views/layouts/footer.blade.php --}}
        @include('layouts.footer') 
        {{-- ============================================= --}}

    </body>
</html>