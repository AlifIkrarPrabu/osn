<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classroom extends Model {
    // Karena nama tabel Anda 'classrooms' (jamak), Laravel biasanya otomatis tahu. 
    // Tapi menambahkan ini akan lebih aman.
    protected $table = 'classrooms';

    protected $fillable = ['name', 'teacher_id'];

    /**
     * Hubungan ke Materi
     * Karena Anda menggunakan tabel 'classroom_material', 
     * kita harus menyebutkan nama tabelnya secara eksplisit di sini.
     */
    public function materials(): BelongsToMany {
        return $this->belongsToMany(Material::class, 'classroom_material', 'classroom_id', 'material_id');
    }

    /**
     * Hubungan ke Siswa
     * Ini relasi baru yang kita buat untuk fitur 'Tambah Siswa'.
     * Menghubungkan Classroom ke User (sebagai siswa) melalui tabel 'classroom_student'.
     */
    public function students(): BelongsToMany {
        return $this->belongsToMany(User::class, 'classroom_student', 'classroom_id', 'student_id');
    }
}