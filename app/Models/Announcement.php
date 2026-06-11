<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    protected $fillable = ['classroom_id', 'user_id', 'title', 'content'];

    // Relasi untuk mengetahui pengumuman ini ditujukan ke kelas mana
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    // Relasi untuk mengetahui guru mana yang menerbitkannya
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}