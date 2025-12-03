<x-guest-layout title="Masuk ke Aplikasi">
    {{-- Pembungkus Wajib: Memaksa lebar penuh agar bisa mengabaikan batasan lebar default dari x-guest-layout --}}
    <div class="w-full px-0">
        {{-- Container Utama: Disesuaikan agar LEBAR (proposional horizontal). --}}
        {{-- mx-auto dipertahankan agar berada di tengah, tapi sekarang bisa menggunakan lebar 7xl sepenuhnya. --}}
        <div class="w-full max-w-7xl h-auto md:h-[480px] lg:h-[520px] bg-white shadow-2xl rounded-2xl overflow-hidden flex flex-col md:flex-row border-t-4 border-blue-600 mx-auto my-6">
            
            {{-- Left Column: Illustration (Proporsi lebih besar, background biru muda lembut) --}}
            {{-- Menggunakan lebar 5/12 untuk kolom kiri --}}
            <div class="w-full md:w-5/12 bg-[#E6EEFF] flex items-center justify-center p-6 sm:p-10 relative">
                {{-- Mengganti gambar placeholder, menggunakan ilustrasi 3D yang besar agar kolom kiri terisi penuh --}}
                <img src="{{ asset('assets/images/icon_login.jpg') }}" 
                     onerror="this.onerror=null;this.src='https://i.imgur.com/G5g2mJc.png';"
                     alt="Login Illustration" 
                     class="max-w-full h-auto object-contain p-4 md:p-0">
            </div>

            {{-- Right Column: Login Form (Proporsi lebih kecil, fokus pada form) --}}
            {{-- Menggunakan lebar 7/12 untuk kolom kanan --}}
            <div class="w-full md:w-7/12 px-8 py-10 sm:p-14 flex flex-col justify-center">
                
                {{-- Header --}}
                <h2 class="text-3xl font-bold text-gray-900 mb-0">Sign In</h2>
                <p class="text-gray-600 mb-8 text-sm">Unlock your world.</p>

                {{-- Session Status --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email Field --}}
                    <div class="mb-5">
                        <x-input-label for="email" value="* Email" class="text-gray-700 font-semibold mb-1 text-sm" />
                        <x-text-input id="email" class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm placeholder-gray-400" 
                                      type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter your email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password Field (Tanpa Toggle Mata dan Alpine.js) --}}
                    <div class="mb-8">
                        <x-input-label for="password" value="* Password" class="text-gray-700 font-semibold mb-1 text-sm" />
                        
                        <div class="relative mt-1">
                            {{-- Tipe diatur statis ke 'password' --}}
                            <x-text-input id="password" 
                                        name="password"
                                        required autocomplete="current-password"
                                        placeholder="Enter your password"
                                        type="password"
                                        class="block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm placeholder-gray-400" />

                            {{-- Tombol Mata dihilangkan. --}}
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Sign In Button (Biru solid) --}}
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="w-full justify-center bg-blue-600 border-blue-700 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-md transition duration-200 transform hover:scale-[1.01]">
                            Sign In
                        </x-primary-button>
                    </div>
                </form>

                {{-- Create an account Button (Biru outline) --}}
                <div class="text-center mt-4">
                    {{-- Disesuaikan agar menjadi tombol outline yang terlihat mirip dengan gambar --}}
                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-3 bg-white border border-gray-300 rounded-lg font-bold text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 w-full justify-center text-sm">
                        Create an account
                    </a>
                </div>

                {{-- Optional: "Forgot your password?" link dihilangkan karena tidak ada di gambar --}}
            </div>
        </div>
    </div> {{-- Penutup pembungkus w-full px-0 --}}
</x-guest-layout>
