<x-guest-layout>
    {{-- Pembungkus Wajib: Memaksa lebar penuh agar bisa mengabaikan batasan lebar default dari x-guest-layout --}}
    <div class="w-full px-0">
        {{-- Container Utama: Disesuaikan agar LEBAR (proposional horizontal). --}}
        {{-- Menggunakan lebar 7xl, tinggi sedang (480-520px) --}}
        <div class="w-full max-w-7xl h-auto md:h-[550px] lg:h-[600px] bg-white shadow-2xl rounded-2xl overflow-hidden flex flex-col md:flex-row border-t-4 border-green-600 mx-auto my-6">
            
            {{-- Left Column: Illustration (Proporsi lebih besar, background biru muda lembut) --}}
            {{-- Menggunakan lebar 5/12 untuk kolom kiri --}}
            <div class="w-full md:w-5/12 bg-[#E6EEFF] flex items-center justify-center p-6 sm:p-10 relative">
                {{-- Placeholder Ilustrasi 3D --}}
                <img src="{{ asset('assets/images/icon_login.jpg') }}" 
                     onerror="this.onerror=null;this.src='https://i.imgur.com/G5g2mJc.png';"
                     alt="Register Illustration" 
                     class="max-w-full h-auto object-contain p-4 md:p-0">
            </div>

            {{-- Right Column: Registration Form (Proporsi lebih kecil, fokus pada form) --}}
            {{-- Menggunakan lebar 7/12 untuk kolom kanan --}}
            <div class="w-full md:w-7/12 px-8 py-8 sm:p-14 flex flex-col justify-center">
                
                {{-- Header --}}
                <h2 class="text-3xl font-bold text-gray-900 mb-0">Create Account</h2>
                <p class="text-gray-600 mb-6 text-sm">Register to start your journey.</p>

                {{-- Validation Errors --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Name Field (Nama Lengkap) --}}
                    <div class="mb-4">
                        <x-input-label for="name" value="Nama Lengkap" class="text-gray-700 font-semibold mb-1 text-sm" />
                        <x-text-input id="name" class="block w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm placeholder-gray-400" 
                                      type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Lengkap Sesuai Ijazah" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Email Field (Email Aktif) --}}
                    <div class="mb-4">
                        <x-input-label for="email" value="Email" class="text-gray-700 font-semibold mb-1 text-sm" />
                        <x-text-input id="email" class="block w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm placeholder-gray-400" 
                                      type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email Aktif" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password Field (Buat Kata Sandi Baru) --}}
                    <div class="mb-4">
                        <x-input-label for="password" value="Password" class="text-gray-700 font-semibold mb-1 text-sm" />
                        <x-text-input id="password" class="block w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm placeholder-gray-400" 
                                      type="password" name="password" required autocomplete="new-password" placeholder="Buat Kata Sandi Baru" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Confirm Password Field (Konfirmasi Password) --}}
                    <div class="mb-8">
                        <x-input-label for="password_confirmation" value="Konfirmasi Password" class="text-gray-700 font-semibold mb-1 text-sm" />
                        <x-text-input id="password_confirmation" class="block w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm placeholder-gray-400" 
                                      type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi Kata Sandi" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    {{-- DAFTAR SEKARANG Button (Hijau solid) --}}
                    <x-primary-button class="w-full justify-center bg-green-600 border-green-700 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow-md transition duration-200 transform hover:scale-[1.01]">
                        DAFTAR SEKARANG
                    </x-primary-button>
                </form>

                {{-- Sudah punya akun? Masuk --}}
                <div class="text-center mt-4 text-sm">
                    <p class="text-gray-600">Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-semibold text-green-600 hover:text-green-800 underline">
                            Masuk
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div> {{-- Penutup pembungkus w-full px-0 --}}
</x-guest-layout>
