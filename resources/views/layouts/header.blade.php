<header class="shadow-lg sticky top-0 z-50 bg-[#1e4fa1]">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
        <!-- Logo Section -->
        <div class="flex items-center gap-2">
            <!-- Ganti src dengan logo asli Anda jika ada -->
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-10 w-auto" onerror="this.style.display='none'">
            <span class="text-xl font-extrabold text-white tracking-tight">
                LMS OSN <span class="font-normal text-blue-100">SOC Indonesia</span>
            </span>
        </div>

        <!-- Navigation Links -->
        <div class="hidden md:flex items-center space-x-6">
            <a href="{{ url('/') }}" class="text-white font-medium relative group py-5">
                Home
                <span class="absolute bottom-3 left-0 w-full h-0.5 bg-yellow-400"></span> <!-- Active indicator -->
            </a>
            <a href="#" class="text-blue-100 hover:text-white font-medium transition duration-200">Tentang OSN</a>
            <a href="#" class="text-blue-100 hover:text-white font-medium transition duration-200">Materi</a>
            <a href="#" class="text-blue-100 hover:text-white font-medium transition duration-200">Kontak</a>
        </div>

        <!-- Auth Buttons -->
        <div class="flex items-center gap-3">
            @auth
                {{-- Jika pengguna sudah login --}}
                <div class="flex items-center gap-2">
                    <a href="{{ route('dashboard') }}" class="text-white border border-white/30 hover:bg-white/10 font-semibold py-2 px-5 rounded-md transition duration-200">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-white text-[#1e4fa1] hover:bg-blue-50 font-bold py-2 px-6 rounded-md shadow-sm transition duration-200">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                {{-- Jika pengguna belum login (Sesuai gambar referensi) --}}
                <a href="{{ route('login') }}" class="text-white border border-white/40 hover:bg-white/10 font-semibold py-2 px-6 rounded-md transition duration-200">
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-white text-[#1e4fa1] hover:bg-blue-50 font-bold py-2 px-6 rounded-md shadow-sm transition duration-200">
                    Daftar
                </a>
            @endauth
        </div>

        <!-- Mobile Menu Button (Optional) -->
        <div class="md:hidden flex items-center">
            <button class="text-white hover:text-blue-200">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </nav>
</header>