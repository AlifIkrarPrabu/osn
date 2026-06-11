@extends('layouts.app', ['title' => 'Courses'])

@section('content')
@php
    function iconHtml($name, $size = 20) {
        $icons = [
            'dashboard' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>',
            'users' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
            'courses' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>',
        ];
        return $icons[$name] ?? '';
    }
@endphp

<div class="flex h-screen bg-gray-100 font-sans antialiased">

    <!-- Sidebar Navigasi -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 shadow-xl transition-transform duration-300 transform -translate-x-full md:relative md:translate-x-0">
        <div class="p-6 text-xl font-extrabold text-blue-600 border-b border-gray-200 flex justify-between items-center">
            <span>Admin</span>
        </div>
        
        <nav class="p-4 space-y-2">
            @php
                $navItems = [
                    ['name' => 'Dashboard', 'icon' => 'dashboard', 'route' => route('admin.dashboard'), 'active' => false],
                    ['name' => 'Users', 'icon' => 'users', 'route' => route('admin.users.index'), 'active' => false],
                    ['name' => 'Course', 'icon' => 'courses', 'route' => route('admin.materials.index'), 'active' => true],
                ];
            @endphp

            @foreach ($navItems as $item)
                <a href="{{ $item['route'] }}" 
                    class="flex items-center p-3 rounded-xl transition duration-150 ease-in-out 
                    {{ $item['active'] ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <span class="mr-3">{!! iconHtml($item['icon'], 20) !!}</span>
                    {{ $item['name'] }}
                </a>
            @endforeach
        </nav>
    </aside>
    
    <!-- Konten Utama -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- Header / Navbar -->
        <header class="flex items-center justify-between px-4 sm:px-6 py-4 bg-white border-b border-gray-200 shadow-sm sticky top-0 z-10">
            <div class="flex items-center space-x-4">
                <button id="mobile-menu-button" class="text-gray-500 focus:outline-none md:hidden p-2 hover:bg-gray-100 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
                <div class="text-xl font-bold text-gray-800">Materi Pembelajaran</div>
            </div>
            <div class="flex items-center gap-2">
                <div class="hidden sm:block text-sm text-gray-500 mr-2">Admin Sekolah</div>
            </div>
        </header>

        <!-- Main Scroll Area -->
        <main class="flex-1 overflow-y-auto bg-gray-50 p-4 sm:p-6 lg:p-8">
            <div class="max-w-7xl mx-auto">
                
                <!-- Judul & Tombol Tambah -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Daftar Materi</h2>
                        <p class="text-sm text-gray-600">Kelola konten edukasi untuk seluruh bidang OSN.</p>
                    </div>
                    <a href="{{ route('admin.materials.create') }}" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold flex items-center justify-center transition shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Materi
                    </a>
                </div>

                <!-- Kontainer Data -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    
                    <!-- Mode Tabel (Hanya muncul di Desktop md keatas) -->
                    <div class="hidden md:block">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wider">
                                <tr>
                                    <th class="px-6 py-4 font-bold text-gray-500">Judul Materi</th>
                                    <th class="px-6 py-4 font-bold text-gray-500">Kategori</th>
                                    <th class="px-6 py-4 font-bold text-gray-500">Penulis</th>
                                    <th class="px-6 py-4 font-bold text-gray-500 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($materials as $material)
                                <tr class="hover:bg-blue-50/50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $material->title }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-[10px] font-bold uppercase">
                                            {{ $material->category ?? 'Umum' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $material->user->name ?? 'Admin' }}</td>
                                    <td class="px-6 py-4 text-right space-x-3 text-sm">
                                        <a href="{{ route('admin.materials.edit', $material->id) }}" class="text-blue-600 font-bold hover:text-blue-800 transition">Edit</a>
                                        <form action="{{ route('admin.materials.destroy', $material->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus materi ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500 font-bold hover:text-red-700 transition">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-400">Belum ada data materi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mode Mobile (Card Layout - Muncul di layar kecil) -->
                    <div class="md:hidden divide-y divide-gray-100">
                        @forelse($materials as $material)
                        <div class="p-4 flex flex-col gap-3">
                            <div class="flex justify-between items-start">
                                <div class="flex-1 pr-2">
                                    <h3 class="font-bold text-gray-900 leading-tight">{{ $material->title }}</h3>
                                    <p class="text-xs text-gray-500 mt-1">Penulis: {{ $material->user->name ?? 'Admin' }}</p>
                                </div>
                                <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded text-[10px] font-bold uppercase whitespace-nowrap">
                                    {{ $material->category ?? 'Umum' }}
                                </span>
                            </div>
                            
                            <div class="flex items-center gap-2 pt-2 border-t border-gray-50">
                                <a href="{{ route('admin.materials.edit', $material->id) }}" 
                                   class="flex-1 text-center py-2 bg-blue-50 text-blue-600 rounded-lg text-xs font-bold hover:bg-blue-100 transition">
                                   Edit
                                </a>
                                <form action="{{ route('admin.materials.destroy', $material->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus materi ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full text-center py-2 bg-red-50 text-red-600 rounded-lg text-xs font-bold hover:bg-red-100 transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="p-10 text-center text-gray-400 text-sm">Belum ada data materi.</div>
                        @endforelse
                    </div>

                </div>
            </div>
        </main>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const closeBtn = document.getElementById('close-sidebar');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        btn.addEventListener('click', toggleSidebar);
        closeBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    });
</script>
@endsection