<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'material_id',
        'type',        // multiple_choice, essay
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
