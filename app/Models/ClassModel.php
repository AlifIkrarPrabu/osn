<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $table = 'classes';
    protected $fillable = ['name', 'description', 'teacher_id'];

    // Relasi ke Materi
    public function materials() {
        return $this->hasMany(Material::class, 'class_id');
    }

    // Relasi ke Siswa
    public function students() {
        return $this->belongsToMany(User::class, 'class_student', 'class_id', 'student_id');
    }
}
