<x-guest-layout>
    <x-slot name="title">
        Sign Up
    </x-slot>

    {{-- Wrapper Utama dengan Background Gradasi --}}
    <div class="min-h-screen w-full flex items-center justify-center p-4 sm:p-6" 
         style="background: linear-gradient(135deg, #6699ff 0%, #3366cc 100%); background-attachment: fixed;">
        
        {{-- Container Utama --}}
        <div class="w-full max-w-6xl h-auto md:h-[650px] shadow-2xl rounded-[2.5rem] overflow-hidden flex flex-col md:flex-row mx-auto border border-white/20">
            
            {{-- Left Column: Illustration (Transparan & Zoomed Image) --}}
            <div class="w-full md:w-5/12 bg-transparent flex items-center justify-center p-4 relative overflow-hidden">
                {{-- 
                    Penjelasan Zoom: 
                    - 'scale-125' memperbesar gambar 125%
                    - 'md:scale-150' memperbesar lebih ekstrim di layar desktop
                    - 'max-w-none' agar tidak dibatasi lebar kontainer
                    - 'w-4/5' atau 'w-full' untuk mengatur basis ukuran
                --}}
                <img src="{{ asset('assets/images/icon_login.jpg') }}" 
                     onerror="this.onerror=null;this.src='https://i.imgur.com/G5g2mJc.png';"
                     alt="Register Illustration" 
                     class="w-full h-auto object-contain drop-shadow-2xl transform transition duration-500 hover:scale-150 scale-150 md:scale-175">
            </div>

            {{-- Right Column: Registration Form --}}
            <div class="w-full md:w-7/12 px-10 py-10 sm:p-16 flex flex-col justify-center bg-white">
                
                <h2 class="text-3xl font-bold text-[#4A4A4A] mb-1">Create Account</h2>
                <p class="text-gray-500 mb-8 text-sm">Register to start your journey.</p>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <x-input-label for="name" value="Nama Lengkap" class="text-gray-600 font-medium mb-1 text-xs uppercase tracking-wider" />
                        <x-text-input id="name" class="block w-full border-gray-200 bg-gray-50 focus:border-blue-400 focus:ring-blue-400 rounded-xl shadow-sm placeholder-gray-400 py-3" 
                                      type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Lengkap Sesuai Ijazah" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    {{-- Email --}}
                    <div>
                        <x-input-label for="email" value="Email" class="text-gray-600 font-medium mb-1 text-xs uppercase tracking-wider" />
                        <x-text-input id="email" class="block w-full border-gray-200 bg-gray-50 focus:border-blue-400 focus:ring-blue-400 rounded-xl shadow-sm placeholder-gray-400 py-3" 
                                      type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email Aktif" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <x-input-label for="password" value="Password" class="text-gray-600 font-medium mb-1 text-xs uppercase tracking-wider" />
                        <x-text-input id="password" class="block w-full border-gray-200 bg-gray-50 focus:border-blue-400 focus:ring-blue-400 rounded-xl shadow-sm placeholder-gray-400 py-3" 
                                      type="password" name="password" required autocomplete="new-password" placeholder="Buat Kata Sandi Baru" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-6">
                        <x-input-label for="password_confirmation" value="Konfirmasi Password" class="text-gray-600 font-medium mb-1 text-xs uppercase tracking-wider" />
                        <x-text-input id="password_confirmation" class="block w-full border-gray-200 bg-gray-50 focus:border-blue-400 focus:ring-blue-400 rounded-xl shadow-sm placeholder-gray-400 py-3" 
                                      type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi Kata Sandi" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>

                    <button type="submit" class="w-full bg-[#2D9C6C] hover:bg-[#25855A] text-white font-bold py-4 rounded-xl shadow-lg transition duration-300 transform hover:scale-[1.02] active:scale-[0.98] uppercase tracking-widest text-sm">
                        DAFTAR SEKARANG
                    </button>
                </form>

                <div class="text-center mt-6 text-sm">
                    <p class="text-gray-500">Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-bold text-[#2D9C6C] hover:text-[#25855A] transition-colors">
                            Masuk
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>