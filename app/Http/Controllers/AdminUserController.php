<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // Menampilkan daftar user yang belum disetujui dan yang sudah
    public function index()
    {
        // Mengambil user dengan role 'user' (bukan admin)
        $users = User::where('role', 'user')->get();
        return view('admin.users.index', compact('users'));
    }

    // Fungsi untuk menyetujui user
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_approved' => true]);

        return redirect()->back()->with('success', 'Akun user berhasil disetujui.');
    }

    // Fungsi untuk menolak/menghapus user (Opsional)
    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Pendaftaran user telah ditolak dan dihapus.');
    }
}