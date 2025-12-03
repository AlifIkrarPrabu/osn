@extends('layouts.app', ['title' => 'Admin Dashboard'])

@section('content')

@php
    function iconHtml($name, $size = 20) {
        $icons = [
            'dashboard' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>',

            'users' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',

            'courses' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>',

            'reports' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide"><line x1="12" x2="12" y1="20" y2="10"/><line x1="18" x2="18" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="16"/></svg>',

            'settings' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide"><path d="M12 8a4 4 0 1 0 4 4 4 4 0 0 0-4-4Z"/><path d="M3.05 11H1a11 11 0 0 1 1.22-4.78l1.7.98"/><path d="m6.18 4.93 1-1.73A11 11 0 0 1 17 3.05l-.98 1.7"/><path d="M21 11h2a11 11 0 0 1-1.22 4.78l-1.7-.98"/><path d="m17.82 19.07-1 1.73A11 11 0 0 1 7 20.95l.98-1.7"/><path d="M3.05 13H1"/><path d="m4.93 17.82-1.73 1"/><path d="m19.07 6.18 1.73-1"/></svg>',

            'activity-logs' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 12H7"/><path d="M17 16H7"/><path d="M17 14H7"/></svg>',

            /* === FIX NEW ICONS HERE === */

            // NEW Student Icon (better & clean)
            'student-icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 10-10-5L2 10l10 5 10-5Z"/><path d="M6 12v5a6 6 0 0 0 12 0v-5"/></svg>',

            // NEW Teacher Icon (school lucide)
            'teacher-icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7V4a2 2 0 0 1 2-2h3"/><path d="M20 7V4a2 2 0 0 0-2-2h-3"/><path d="M4 7v13a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7"/><path d="M9 12h6"/><path d="M12 9v6"/></svg>',

            'desktop-icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="3" rx="2"/><line x1="12" x2="12" y1="17" y2="21"/><line x1="8" x2="16" y1="21" y2="21"/></svg>',

            'course-box-icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H10"/><path d="M20 19.5v-15A2.5 2.5 0 0 0 17.5 2H14"/><path d="M8 7h4"/><path d="M10 5v4"/></svg>',

            'bell' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.36 18a2 2 0 0 0 3.28 0"/></svg>',

            'link' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.73 1.74"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>',
        ];

        return $icons[$name] ?? '';
    }
@endphp

<div class="flex h-screen bg-gray-100 font-sans antialiased">
    
    <!-- Sidebar Navigasi -->
    <div class="flex-shrink-0 w-64 bg-white border-r border-gray-200 shadow-xl transition-all duration-300 transform -translate-x-full md:translate-x-0 fixed inset-y-0 left-0 z-30 md:static md:block" id="sidebar">
        <div class="p-6 text-xl font-extrabold text-blue-600 border-b border-gray-200">
            Admin
        </div>
        
        <!-- Menu Sidebar -->
        <nav class="p-4 space-y-2">
            @php
                $navItems = [
                    ['name' => 'Dashboard', 'icon' => 'dashboard', 'route' => route('admin.dashboard'), 'active' => true],
                    ['name' => 'Users', 'icon' => 'users', 'route' => route('admin.users.index'), 'active' => false],
                    ['name' => 'Courses', 'icon' => 'courses', 'route' => '#', 'active' => false],
                    ['name' => 'Reports', 'icon' => 'reports', 'route' => '#', 'active' => false],
                    ['name' => 'Settings', 'icon' => 'settings', 'route' => '#', 'active' => false],
                    ['name' => 'Notifications', 'icon' => 'bell', 'route' => '#', 'active' => false],
                    ['name' => 'Integrations', 'icon' => 'link', 'route' => '#', 'active' => false],
                    ['name' => 'Activity Logs', 'icon' => 'activity-logs', 'route' => '#', 'active' => false],
                ];
            @endphp

            @foreach ($navItems as $item)
                <a href="{{ $item['route'] }}" 
                    class="flex items-center p-3 rounded-xl transition duration-150 ease-in-out 
                    @if($item['active']) 
                        bg-blue-50 text-blue-700 font-semibold shadow-sm
                    @else 
                        text-gray-600 hover:bg-gray-100 hover:text-gray-900 
                    @endif">
                    
                    <span class="mr-3">{!! iconHtml($item['icon'], 20) !!}</span>
                    {{ $item['name'] }}
                </a>
            @endforeach
        </nav>
    </div>
    
    <!-- Konten Utama -->
    <div class="flex-1 flex flex-col overflow-hidden">
        
        <!-- Header Utama / Navbar Dashboard -->
        <header class="flex items-center justify-between px-4 sm:px-6 py-4 bg-white border-b border-gray-200 shadow-sm sticky top-0 z-10">
            <div class="flex items-center space-x-4">
                {{-- Tombol Hamburger untuk Mobile --}}
                <button id="mobile-menu-button" class="text-gray-500 focus:outline-none md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
                <div class="text-2xl font-bold text-gray-800 hidden md:block">Admin Dashboard</div>
            </div>
            
        </header>

        <!-- Area Scrollable Konten Dashboard -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-4 md:p-6">
            
            <h3 class="text-xl font-semibold text-gray-700 mb-6">General Statistic</h3>
            
            <!-- 1. Statistik Ringkasan (Cards) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                @php
                    // Pastikan variabel $totalStudents dan $totalTeachers sudah tersedia dari Controller
                    $stats = [
                        // 1. Jumlah Siswa (MENGGUNAKAN VARIABEL DINAMIS)
                        ['label' => 'Total Students', 'count' => $totalStudents, 'icon' => 'student-icon', 'color' => 'indigo'],
                        // 2. Jumlah Guru (MENGGUNAKAN VARIABEL DINAMIS)
                        ['label' => 'Total Teachers', 'count' => $totalTeachers, 'icon' => 'teacher-icon', 'color' => 'teal'],
                        ['label' => 'Active Users', 'count' => '5', 'icon' => 'desktop-icon', 'color' => 'blue'],
                        ['label' => 'Active Courses', 'count' => '5', 'icon' => 'course-box-icon', 'color' => 'red'],
                    ];
                @endphp

                @foreach ($stats as $stat)
                    @php
                        // Membangun string class warna lengkap
                        $borderClass = "border-{$stat['color']}-500";
                        $bgColor = "bg-{$stat['color']}-50";
                        $iconColor = "text-{$stat['color']}-500";
                    @endphp
                    
                    <div class="bg-white p-5 rounded-xl shadow-lg border-t-4 {{ $borderClass }} transition duration-300 hover:shadow-xl hover:scale-[1.01]">
                        <div class="flex items-center space-x-4">
                            <span class="p-3 rounded-full {{ $bgColor }} {{ $iconColor }}">
                                {!! iconHtml($stat['icon'], 28) !!}
                            </span>
                            <div>
                                {{-- Pastikan output di-cast ke string jika count adalah integer --}}
                                <p class="text-3xl font-bold text-gray-900">{{ (string)$stat['count'] }}</p> 
                                <p class="text-sm font-medium text-gray-500">{{ $stat['label'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- 2. Konten Utama Dashboard (User Management, Course Management) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                
                {{-- Kiri: User Management (Telah Dimodifikasi untuk Data Dinamis) --}}
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="mr-2 text-blue-500">{!! iconHtml('users') !!}</span>
                        User Management
                    </h4>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    <th class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                {{-- MEMULAI PERULANGAN DINAMIS --}}
                                @forelse ($users as $user) {{-- Diasumsikan variabel $users dikirim dari Controller --}}
                                    @php
                                        // Logika untuk menentukan warna badge berdasarkan role
                                        $role = strtolower($user->role ?? 'none'); // Ambil role dan ubah ke lowercase (ganti 'role' jika nama kolom berbeda)
                                        $badgeClass = 'bg-gray-100 text-gray-800'; // Default
                                        
                                        if ($role === 'admin') {
                                            $badgeClass = 'bg-red-100 text-red-800';
                                        } elseif ($role === 'guru' || $role === 'teacher') {
                                            $badgeClass = 'bg-pink-100 text-pink-800';
                                        } elseif ($role === 'siswa' || $role === 'student') {
                                            $badgeClass = 'bg-green-100 text-green-800';
                                        }
                                    @endphp
                                    <tr>
                                        {{-- Menampilkan Nama User --}}
                                        <td class="px-3 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $user->name ?? 'N/A' }} {{-- Pastikan nama kolom user adalah 'name' --}}
                                        </td>
                                        {{-- Menampilkan Role User --}}
                                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">
                                                {{ ucfirst($role) }} {{-- Menampilkan Role dengan huruf besar di awal --}}
                                            </span>
                                        </td>
                                        {{-- Kolom Aksi --}}
                                        <td class="px-3 py-3 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.users.index', $user->id ?? '#') }}" class="text-blue-600 hover:text-blue-900 transition duration-150">Lihat</a>
                                        </td>
                                    </tr>
                                @empty
                                    {{-- Tampilkan jika data user kosong --}}
                                    <tr>
                                        <td colspan="3" class="px-3 py-4 text-center text-sm text-gray-500">Tidak ada data pengguna yang tersedia.</td>
                                    </tr>
                                @endforelse
                                {{-- MENGAKHIRI PERULANGAN DINAMIS --}}
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4 flex justify-end">
                        <a href="{{ route('admin.users.index') }}" class="flex items-center rounded-lg p-2 hover:bg-gray-100 transition duration-150">
                            <span class="ml-3">Kelola Pengguna</span>
                        </a>
                    </div>
                </div>

                {{-- Kanan: Course Management --}}
                <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="mr-2 text-teal-500">{!! iconHtml('courses') !!}</span>
                        Course Management
                    </h4>
                    
                    {{-- Placeholder Chart: Bar Chart untuk Jumlah Pelajaran --}}
                    <div class="flex-grow flex items-end justify-around h-48 bg-gray-50 rounded-lg p-3 space-x-2">
                        @php
                            $courses = [
                                ['label' => 'Math', 'count' => 80, 'color' => 'bg-red-400'],
                                ['label' => 'Science', 'count' => 120, 'color' => 'bg-yellow-400'],
                                ['label' => 'Art', 'count' => 50, 'color' => 'bg-green-400'],
                                ['label' => 'History', 'count' => 90, 'color' => 'bg-blue-400'],
                            ];
                            $maxCount = 120;
                        @endphp

                        @foreach ($courses as $course)
                            <div class="flex flex-col items-center justify-end w-1/4 h-full" title="{{ $course['label'] }}: {{ $course['count'] }} students">
                                <div class="w-full rounded-t-lg transition duration-300 hover:opacity-80 {{ $course['color'] }} shadow-md" 
                                    style="height: {{ ($course['count'] / $maxCount) * 90 + 10 }}%;">
                                </div>
                                <span class="mt-1 text-xs text-gray-500">{{ $course['label'] }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 flex justify-end">
                        <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition duration-150">Kelola Kursus →</a>
                    </div>
                </div>
            </div>
            
            <!-- 3. Konten Baris Bawah (Activity Logs) -->
            <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
                
                {{-- Baris Penuh: Activity Logs --}}
                <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="mr-2 text-orange-500">{!! iconHtml('activity-logs') !!}</span>
                        5. Activity Logs
                    </h4>
                    
                    {{-- Timeline/Log Sederhana --}}
                    <ol class="relative border-l border-gray-200 ml-3">
                        @php
                            $logs = [
                                ['time' => '10:30 AM', 'user' => 'Admin User', 'action' => 'Updated system settings.', 'color' => 'yellow'],
                                ['time' => 'Yesterday', 'user' => 'Student A', 'action' => 'Completed "Introduction to PHP".', 'color' => 'green'],
                                ['time' => '2 days ago', 'user' => 'Teacher B', 'action' => 'Added a new quiz to "Advanced Math".', 'color' => 'indigo'],
                                ['time' => 'Last week', 'user' => 'System', 'action' => 'Database backup successful.', 'color' => 'blue'],
                            ];
                        @endphp
                        
                        @foreach ($logs as $log)
                            {{-- Gunakan PHP untuk membangun string class warna lengkap --}}
                            @php
                                $dotColorClass = "bg-{$log['color']}-400";
                            @endphp
                            <li class="mb-4 ml-6">
                                <span class="absolute flex items-center justify-center w-3 h-3 {{ $dotColorClass }} rounded-full -left-1.5 ring-8 ring-white"></span>
                                <p class="text-sm font-semibold text-gray-900">{{ $log['action'] }}</p>
                                <time class="block mb-2 text-xs font-normal leading-none text-gray-400">{{ $log['time'] }} by {{ $log['user'] }}</time>
                            </li>
                        @endforeach
                    </ol>

                    <div class="mt-4 flex justify-end">
                        <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition duration-150">Lihat Semua Log →</a>
                    </div>
                </div>
            </div>

        </main>
    </div>
    
</div>

<script>
    // Logika untuk menampilkan/menyembunyikan sidebar di mobile (Hamburger Menu)
    const sidebar = document.getElementById('sidebar');
    const mobileMenuButton = document.getElementById('mobile-menu-button');

    if (mobileMenuButton && sidebar) {
        mobileMenuButton.addEventListener('click', () => {
            // Toggle kelas translate-x-0 untuk menampilkan/menyembunyikan sidebar
            sidebar.classList.toggle('-translate-x-full');
        });
    }

    // Menutup sidebar jika di luar area diklik (Hanya berlaku untuk tampilan mobile saat sidebar muncul)
    document.addEventListener('click', (event) => {
        // Cek apakah mode mobile (lebar kurang dari md/768px)
        const isMobile = window.innerWidth < 768; 
        
        // Cek jika sidebar terlihat
        const isSidebarVisible = !sidebar.classList.contains('-translate-x-full');

        // Jika mode mobile, sidebar terlihat, dan klik di luar sidebar atau tombol menu
        if (isMobile && isSidebarVisible && !sidebar.contains(event.target) && !mobileMenuButton.contains(event.target)) {
            // Sembunyikan sidebar
            sidebar.classList.add('-translate-x-full');
        }
    });

</script>
@endsection