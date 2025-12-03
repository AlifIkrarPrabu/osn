<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna dengan fitur pencarian nama.
     */
    public function index(Request $request)
    {
        // Ambil input pencarian
        $search = $request->input('search');

        // Query pengguna non-admin + fitur pencarian
        $users = User::where('role', '!=', 'admin')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->paginate(10);

        // Kirim $search kembali ke blade agar input tetap terisi
        return view('admin.users.index', compact('users', 'search'));
    }

    /**
     * Menghapus pengguna tertentu.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', "Anda tidak dapat menghapus akun Anda sendiri.");
        }

        $user->delete();
        return back()->with('success', "Pengguna '{$user->name}' berhasil dihapus.");
    }

    /**
     * Memperbarui Nama, Email, dan Password (opsional).
     */
    public function updateDetails(Request $request, User $user)
    {
        // Validasi
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email ini sudah digunakan oleh pengguna lain.',
            'password.min' => 'Kata sandi minimal harus 8 karakter.',
        ]);

        try {
            // Siapkan data update
            $updateData = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
            ];

            // Jika password diisi, enkripsi
            if (!empty($validatedData['password'])) {
                $updateData['password'] = Hash::make($validatedData['password']);
            }

            // Update database
            $user->update($updateData);

            return back()->with('success', "Detail pengguna '{$user->name}' berhasil diperbarui.");
            
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui pengguna: ' . $e->getMessage());

            return back()
                ->withErrors(['update_failed' => 'Terjadi kesalahan sistem saat memperbarui pengguna.'])
                ->withInput(array_merge($request->all(), ['user_id_on_fail' => $user->id]))
                ->with('error', 'Gagal memperbarui pengguna. Silakan coba lagi.');
        }
    }
}
