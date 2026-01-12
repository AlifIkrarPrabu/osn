<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    protected $fillable = [
        'student_id',
        'task_id',
        'answer',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
