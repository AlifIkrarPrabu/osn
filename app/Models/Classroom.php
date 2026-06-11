<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany; // Tambahkan ini

class Classroom extends Model {
    protected $table = 'classrooms';

    protected $fillable = ['name', 'teacher_id'];

    /**
     * Hubungan ke Tugas (Assignments) - BARU TAMBAHAN
     * Satu kelas bisa memiliki banyak tugas pilihan ganda.
     */
    public function assignments(): HasMany {
        return $this->hasMany(Assignment::class, 'classroom_id');
    }

    /**
     * Hubungan ke Materi
     */
    public function materials(): BelongsToMany {
        return $this->belongsToMany(Material::class, 'classroom_material', 'classroom_id', 'material_id');
    }

    /**
     * Hubungan ke Siswa
     */
    public function students(): BelongsToMany {
        return $this->belongsToMany(User::class, 'classroom_student', 'classroom_id', 'student_id')
        ->withTimestamps();
    }
}