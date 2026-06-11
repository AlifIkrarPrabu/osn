<header class="shadow-lg sticky top-0 z-50 bg-[#1e4fa1]" x-data="{ open: false }">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo Section -->
            <div class="flex items-center gap-2 flex-shrink-0">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-9 w-auto" onerror="this.style.display='none'">
                <span class="text-lg md:text-xl font-extrabold text-white tracking-tight leading-tight">
                    LMS OSN <span class="hidden sm:inline font-normal text-blue-100">SOC Indonesia</span>
                </span>
            </div>

            <!-- Desktop Navigation Links (Hidden on Mobile) -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ url('/') }}" class="text-white font-medium relative group py-5">
                    Home
                    <span class="absolute bottom-3 left-0 w-full h-0.5 bg-yellow-400"></span>
                </a>
                <a href="#" class="text-blue-100 hover:text-white font-medium transition duration-200">Tentang OSN</a>
                <a href="#" class="text-blue-100 hover:text-white font-medium transition duration-200">Materi</a>
                <a href="#" class="text-blue-100 hover:text-white font-medium transition duration-200">Kontak</a>
            </div>

            <!-- Desktop Auth Buttons (Hidden on Mobile) -->
            <div class="hidden md:flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-white border border-white/30 hover:bg-white/10 font-semibold py-2 px-5 rounded-md transition duration-200">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-white text-[#1e4fa1] hover:bg-blue-50 font-bold py-2 px-6 rounded-md shadow-sm transition duration-200">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-white border border-white/40 hover:bg-white/10 font-semibold py-2 px-6 rounded-md transition duration-200">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-white text-[#1e4fa1] hover:bg-blue-50 font-bold py-2 px-6 rounded-md shadow-sm transition duration-200">
                        Daftar
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button (Hamburger) -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="text-white focus:outline-none p-2 rounded-md hover:bg-blue-800 transition">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Panel -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden bg-[#1a458d] border-t border-blue-800 shadow-2xl"
         style="display: none;">
        <div class="px-4 pt-4 pb-6 space-y-2">
            <!-- Nav Links -->
            <a href="{{ url('/') }}" class="block px-4 py-3 text-white font-semibold bg-blue-900/50 rounded-lg">Home</a>
            <a href="#" class="block px-4 py-3 text-blue-100 hover:text-white hover:bg-blue-800 rounded-lg transition">Tentang OSN</a>
            <a href="#" class="block px-4 py-3 text-blue-100 hover:text-white hover:bg-blue-800 rounded-lg transition">Materi</a>
            <a href="#" class="block px-4 py-3 text-blue-100 hover:text-white hover:bg-blue-800 rounded-lg transition">Kontak</a>
            
            <div class="pt-4 border-t border-blue-800 mt-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="block w-full text-center px-4 py-3 mb-2 text-white border border-white/30 font-semibold rounded-lg">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full bg-white text-[#1e4fa1] font-bold py-3 rounded-lg shadow-md">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block w-full text-center px-4 py-3 mb-3 text-white border border-white/40 font-semibold rounded-lg">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="block w-full text-center bg-white text-[#1e4fa1] font-bold py-3 rounded-lg shadow-md">
                        Daftar Sekarang
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>