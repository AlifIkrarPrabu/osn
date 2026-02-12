<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Material extends Model
{
    protected $fillable = [
        'title',
        'description',
        'teacher_id',
        'duration',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function examSessions()
    {
        return $this->hasMany(ExamSession::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
