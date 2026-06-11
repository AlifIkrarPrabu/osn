<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany; // Tambahkan ini
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_approved',
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

    /**
     * Hubungan ke Jawaban Tugas (Submissions)
     * Baru: Agar Guru bisa memantau jawaban siswa
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class, 'student_id');
    }

    // Hubungan Many-to-Many ke Classroom (Siswa memiliki banyak kelas)
    public function classrooms(): BelongsToMany
    {
        return $this->belongsToMany(Classroom::class, 'classroom_student', 'student_id', 'classroom_id')
                    ->withTimestamps();
    }
}