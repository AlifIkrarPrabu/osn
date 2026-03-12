<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_approved', // Tambahkan ini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Helper methods
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isGuru(): bool
    {
        return $this->role === 'guru';
    }
    
    public function isSiswa(): bool
    {
        return $this->role === 'siswa';
    }

    // Helper untuk cek approval
    public function isApproved(): bool
    {
        return (bool) $this->is_approved;
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_approved' => 'boolean',
        ];
    }
}