@extends('layouts.app', ['title' => 'Manajemen Pengguna'])

@section('content')

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


    {{-- TABEL --}}
    <div class="overflow-x-auto relative z-0">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($users as $user)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                    </td>

                    <td class="px-4 py-2 text-sm font-medium text-gray-900">
                        {{ $user->name }}
                    </td>

                    <td class="px-4 py-2 text-sm text-gray-500">
                        {{ $user->email }}
                    </td>

                    <td class="px-4 py-2">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($user->role === 'admin') bg-indigo-100 text-indigo-800
                            @elseif($user->role === 'guru') bg-yellow-100 text-yellow-800
                            @else bg-blue-100 text-blue-800
                            @endif
                        ">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>

                    {{-- AKSI --}}
                    <td class="px-4 py-2 text-center text-sm font-medium">

                        {{-- TOMBOL EDIT --}}
                        <button
                            data-user-id="{{ $user->id }}"
                            data-user-name="{{ $user->name }}"
                            data-user-email="{{ $user->email }}"
                            onclick="openEditModal(this)"
                            class="text-indigo-600 hover:text-indigo-900 mr-3 font-semibold hover:underline"
                        >
                            Edit User
                        </button>

                        {{-- FORM HAPUS --}}
                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                              method="POST"
                              class="inline-block"
                              onsubmit="return confirm('Yakin menghapus pengguna {{ e($user->name) }}?');">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="text-red-600 hover:text-red-900 font-semibold hover:underline">
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

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $users->appends(['search' => $search])->links() }}
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
</script>


@endsection
