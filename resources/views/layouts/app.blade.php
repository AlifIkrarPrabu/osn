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

<body class="font-sans antialiased bg-gray-100">

    {{-- WRAPPER UTAMA (KUNCI) --}}
    <div class="min-h-screen flex flex-col">

        {{-- HEADER --}}
        @include('layouts.header')

        {{-- MAIN CONTENT --}}
        <main class="flex-1 overflow-hidden">
            @yield('content')
        </main>

        {{-- FOOTER (TIDAK AKAN PERNAH KETUTUP) --}}
        @include('layouts.footer')

    </div>

</body>
</html>
