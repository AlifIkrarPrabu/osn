<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun ADMIN
        if (! User::where('email', 'admin@osn.com')->exists()) {
            User::create([
                'name' => 'Administrator OSN',
                'email' => 'admin@osn.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
        }

        // 2. Akun GURU
        if (! User::where('email', 'guru@osn.com')->exists()) {
            User::create([
                'name' => 'Guru Pembimbing Sains',
                'email' => 'guru@osn.com',
                'password' => Hash::make('password'), // Password: password
                'role' => 'guru',
            ]);
        }

        // 3. Akun SISWA
        if (! User::where('email', 'siswa@osn.com')->exists()) {
            User::create([
                'name' => 'Siswa Contoh',
                'email' => 'siswa@osn.com',
                'password' => Hash::make('password'), // Password: password
                'role' => 'siswa',
            ]);
        }
    }
}