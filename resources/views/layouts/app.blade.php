<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts: Menggunakan Plus Jakarta Sans agar lebih premium seperti desain sebelumnya -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- 1. VITE (Utama) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- 2. TAILWIND CDN FALLBACK (Penting: Menjamin tampilan di hosting tetap muncul meski Vite error) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'ui-sans-serif', 'system-ui'],
                    },
                    colors: {
                        osnBlue: '#1e4fa1',
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom scrollbar agar lebih cantik */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #1e4fa1; border-radius: 10px; }
        
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900">

    {{-- WRAPPER UTAMA --}}
    <div class="min-h-screen flex flex-col">

        {{-- HEADER --}}
        @include('layouts.header')

        {{-- MAIN CONTENT --}}
        {{-- Hapus 'overflow-hidden' agar scroll normal di halaman panjang --}}
        <main class="flex-1">
            @yield('content')
        </main>

        {{-- FOOTER --}}
        @include('layouts.footer')

    </div>

</body>
</html>