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

        <!-- Tailwind CSS (Asumsi vite sudah menangani resources/css/app.css) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 min-h-screen">
        
        <!-- HEADER DENGAN TOMBOL LOGOUT -->
        <header class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 flex justify-end">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out px-3 py-1 border border-red-300 rounded-md">
                        Logout ({{ Auth::user()->name }})
                    </button>
                </form>
            </div>
        </header>

        <main class="py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            {{-- Menggunakan @yield('content') untuk mendukung @extends/@section --}}
            @yield('content')
        </main>
    </body>
</html>
