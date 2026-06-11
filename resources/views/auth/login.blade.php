<x-guest-layout>
    <x-slot name="title">
        Sign in
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

            {{-- Kolom Kanan: Form Login --}}
            <div class="w-full md:w-7/12 p-8 sm:p-16 flex flex-col justify-center bg-white">
                
                {{-- Header Section --}}
                <div class="mb-10">
                    <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-2">Sign In</h2>
                    <p class="text-lg text-gray-500">Welcome back! Please enter your details.</p>
                </div>

                {{-- Session Status (Success/Error Messages) --}}
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    {{-- Email Field --}}
                    <div>
                        <x-input-label for="email" value="Email Address" class="text-gray-700 font-bold mb-2 ml-1" />
                        <div class="relative">
                            <x-text-input id="email" 
                                class="block w-full px-4 py-4 border-gray-200 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 rounded-xl transition-all duration-200" 
                                type="email" name="email" :value="old('email')" 
                                required autofocus autocomplete="username" 
                                placeholder="name@company.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password Field --}}
                    <div>
                        <div class="flex items-center justify-between mb-2 ml-1">
                            <x-input-label for="password" value="Password" class="text-gray-700 font-bold" />
                        </div>
                        
                        <div class="relative">
                            <x-text-input id="password" 
                                class="block w-full px-4 py-4 border-gray-200 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 rounded-xl transition-all duration-200"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="••••••••"
                                type="password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600 font-medium">Remember this device</span>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="pt-4 space-y-4">
                        <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-700 text-white text-base font-bold py-4 rounded-xl shadow-lg shadow-blue-200 transition duration-300 transform active:scale-95">
                            {{ __('Sign In') }}
                        </x-primary-button>

                        <div class="relative flex items-center py-2">
                            <div class="flex-grow border-t border-gray-200"></div>
                            <span class="flex-shrink mx-4 text-gray-400 text-sm font-medium">New to our platform?</span>
                            <div class="flex-grow border-t border-gray-200"></div>
                        </div>

                        <a href="{{ route('register') }}" 
                           class="inline-flex items-center justify-center w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl font-bold text-gray-700 hover:bg-gray-50 hover:border-blue-300 transition-all duration-200 text-sm">
                            Create a new account
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>