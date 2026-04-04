<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classroom extends Model {
    protected $fillable = ['name', 'teacher_id'];

    // Hubungan Many-to-Many ke Materi
    public function materials(): BelongsToMany {
        return $this->belongsToMany(Material::class);
    }
}