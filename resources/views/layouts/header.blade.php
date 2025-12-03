<header class="shadow-md bg-white sticky top-0 z-50">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <div class="text-xl font-bold text-indigo-700">
            LMS OSN
        </div>

        <div class="hidden md:flex space-x-8 text-gray-600 font-medium">
            <a href="{{ url('/') }}" class="hover:text-indigo-600">Home</a>
            <a href="#" class="hover:text-indigo-600">Tentang OSN</a>
            <a href="#" class="hover:text-indigo-600">Materi</a>
            <a href="#" class="hover:text-indigo-600">Kontak</a>
        </div>

        {{-- LOGIC BARU DITAMBAHKAN DI SINI --}}
        @auth
            {{-- Jika pengguna sudah login, tampilkan tombol ke Dashboard dan Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('dashboard') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-150 ease-in-out mr-3">
                    Dashboard
                </a>
                <button type="submit" class="text-gray-600 hover:text-red-500 font-semibold py-2 px-4 rounded-lg transition duration-150 ease-in-out border border-gray-300 hover:border-red-500">
                    Logout
                </button>
            </form>
        @else
            {{-- Jika pengguna belum login, tampilkan tombol Masuk/Daftar --}}
            <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                Masuk / Daftar
            </a>
        @endauth
        
    </nav>
</header>