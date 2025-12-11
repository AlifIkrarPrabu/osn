<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'title',
        'description',
        'teacher_id',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
