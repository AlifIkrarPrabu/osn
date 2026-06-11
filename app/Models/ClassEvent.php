<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassEvent extends Model
{
    protected $fillable = ['classroom_id', 'user_id', 'title', 'event_date'];

    protected $casts = [
        'event_date' => 'date',
    ];

    // Mengetahui agenda ini milik kelas mana
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    // Mengetahui siapa guru yang membuat agenda ini
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}