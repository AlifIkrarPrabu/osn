@extends('layouts.app', ['title' => 'Manajemen Pengguna'])

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
                    ['name' => 'Dashboard', 'icon' => 'dashboard', 'route' => route('admin.dashboard'), 'active' => false],
                    ['name' => 'Users', 'icon' => 'users', 'route' => route('admin.users.index'), 'active' => true],
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
    <div class="flex-1 flex flex-col">
        
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
<div class="p-6 bg-white rounded-xl shadow-lg m-4 sm:m-6 relative z-10">

    <h1 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-2">Manajemen Pengguna</h1>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-md">
            {{ session('error') }}
        </div>
    @endif


    {{-- 🔍 FORM PENCARIAN --}}
    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4 flex gap-2">
        <input
            type="text"
            name="search"
            placeholder="Cari nama pengguna..."
            value="{{ $search ?? '' }}"
            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
        />

        <button type="submit"
            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            Cari
        </button>

        @if(!empty($search))
            <a href="{{ route('admin.users.index') }}"
                class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                Reset
            </a>
        @endif
    </form>

    <!-- Tombol Tambah User -->
    <button onclick="openAddUserModal()" 
    class="mb-4 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
    Tambah User
    </button>



{{-- TABEL USER --}}

<div class="bg-white rounded-lg shadow overflow-hidden">

    {{-- WRAPPER TABEL --}}
    <div class="relative overflow-x-auto">

        <table class="min-w-full divide-y divide-gray-200">

            {{-- HEADER (STICKY) --}}
            <thead class="bg-gray-50 sticky top-0 z-20">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No.</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Role</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>

        </table>

        {{-- BODY SCROLL (MAKS 6 BARIS) --}}
        <div class="overflow-y-auto max-h-[360px]">
            <table class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white">

                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-700 w-[60px]">
                                {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                            </td>

                            <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                {{ $user->name }}
                            </td>

                            <td class="px-4 py-3 text-sm text-center text-gray-500">
                                {{ $user->email }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                <span class="px-2 inline-flex text-xs font-semibold rounded-full
                                    @if($user->role === 'admin') bg-indigo-100 text-indigo-800
                                    @elseif($user->role === 'guru') bg-yellow-100 text-yellow-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-center text-sm whitespace-nowrap">
                                <button
                                    data-user-id="{{ $user->id }}"
                                    data-user-name="{{ $user->name }}"
                                    data-user-email="{{ $user->email }}"
                                    onclick="openEditModal(this)"
                                    class="text-indigo-600 hover:underline mr-3 font-semibold">
                                    Edit User
                                </button>

                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Yakin menghapus pengguna {{ e($user->name) }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline font-semibold">
                                        Hapus User
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                Tidak ada data pengguna.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    {{-- INFO & PAGINATION (SELALU DI BAWAH, TIDAK TERPOTONG) --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 px-4 py-4 border-t bg-gray-50">
        <div class="text-sm text-gray-600">
            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
        </div>

        <div>
            {{ $users->appends(['search' => $search])->links() }}
        </div>
    </div>
</div>


{{-- ====================== --}}
{{--        MODAL EDIT       --}}
{{-- ====================== --}}

<div id="editUserModal"
     class="fixed inset-0 bg-gray-600 bg-opacity-75 hidden items-center justify-center z-[9999]">

<div class="bg-white rounded-lg overflow-hidden shadow-xl sm:w-full sm:max-w-lg">

    <div class="px-6 py-4">

        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2" id="modalTitle">
            Edit Detail Pengguna
        </h3>

        <form id="editForm" method="POST" action="">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="editNameInput" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="editNameInput"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                    required>
            </div>

            <div class="mb-4">
                <label for="editEmailInput" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="editEmailInput"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                    required>
            </div>

            <div class="mb-4">
                <label for="editPasswordInput" class="block text-sm font-medium text-gray-700">Password Baru (opsional)</label>
                <input type="password" name="password" id="editPasswordInput"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            </div>

            <input type="hidden" name="user_id_on_fail" id="userIdOnFailInput">

    </div>

    <div class="bg-gray-50 px-6 py-3 flex justify-end gap-2">

        <button type="submit"
            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            Simpan
        </button>

        </form>

        <button onclick="closeEditModal()"
            class="px-4 py-2 bg-white border rounded-lg hover:bg-gray-50">
            Batal
        </button>
    </div>

</div>

</div>

{{-- ====================== --}}
{{--      MODAL ADD         --}}
{{-- ====================== --}}

<div id="addUserModal"
     class="fixed inset-0 bg-gray-600 bg-opacity-75 hidden items-center justify-center z-[9999]">

    <div class="bg-white rounded-lg overflow-hidden shadow-xl sm:w-full sm:max-w-lg">

        <div class="px-6 py-4">
            <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">
                Tambah Pengguna Baru
            </h3>

            <form id="addUserForm">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name"
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                           required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email"
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                           required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password"
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                           required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Role</label>
                    <select name="role"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                            required>
                        <option value="guru">Guru</option>
                        <option value="siswa">Siswa</option>
                    </select>
                </div>

            </form>
        </div>

        <div class="bg-gray-50 px-6 py-3 flex justify-end gap-2">
            <button onclick="submitAddUser()"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Simpan
            </button>

            <button onclick="closeAddUserModal()"
                    class="px-4 py-2 bg-white border rounded-lg hover:bg-gray-50">
                Batal
            </button>
        </div>

    </div>

</div>





{{-- SCRIPT --}}
<script>
const updateRouteBase = '{{ route("admin.users.update_details", ["user" => "USER_ID_PLACEHOLDER"]) }}';

function openEditModal(button) {
    const modal = document.getElementById('editUserModal');
    const form  = document.getElementById('editForm');

    const userId = button.dataset.userId;
    const userName = button.dataset.userName;
    const userEmail = button.dataset.userEmail;

    form.action = updateRouteBase.replace('USER_ID_PLACEHOLDER', userId);

    document.getElementById('modalTitle').textContent = 'Edit Detail Pengguna: ' + userName;
    document.getElementById('editNameInput').value = userName;
    document.getElementById('editEmailInput').value = userEmail;

    document.getElementById('editPasswordInput').value = '';
    document.getElementById('userIdOnFailInput').value = userId;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditModal() {
    const modal = document.getElementById('editUserModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

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


// =====================
//  OPEN ADD MODAL
// =====================
function openAddUserModal() {
    const modal = document.getElementById('addUserModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

// =====================
//  CLOSE ADD MODAL
// =====================
function closeAddUserModal() {
    const modal = document.getElementById('addUserModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}


// =====================
//  SUBMIT ADD USER (AJAX)
// =====================
function submitAddUser() {
    const form = document.getElementById('addUserForm');
    const formData = new FormData(form);

    fetch("{{ route('admin.users.store') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: formData
    })
    .then(async response => {
        // Laravel redirect on validation fail = HTML, not JSON
        const contentType = response.headers.get("content-type");
        if (contentType && contentType.includes("application/json")) {
            return response.json();
        } else {
            // Validation fails → reload to show errors
            location.reload();
        }
    })
    .then(result => {
        if (!result) return;

        if (result.success || result.status === 'success') {
            alert("User berhasil ditambahkan!");
            location.reload();
        } else {
            alert(result.message || "Gagal menambahkan pengguna.");
        }
    })
    .catch(() => alert("Terjadi kesalahan saat menyimpan user."));
}


</script>


@endsection
