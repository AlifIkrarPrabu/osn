<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSession extends Model
{
    protected $fillable = [
        'student_id',
        'material_id',
        'started_at',
        'ended_at',
        'is_finished'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'is_finished' => 'boolean',
    ];
}
