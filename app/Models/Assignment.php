<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assignment extends Model {
    protected $fillable = ['title', 'description', 'classroom_id', 'teacher_id', 'deadline'];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function classroom(): BelongsTo {
        return $this->belongsTo(Classroom::class);
    }

    public function teacher(): BelongsTo {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function submissions(): HasMany {
        return $this->hasMany(Submission::class);
    }

    /**
     * Hubungan ke Soal Tugas
     */
    public function questions(): HasMany {
        return $this->hasMany(AssignmentQuestion::class);
    }
}