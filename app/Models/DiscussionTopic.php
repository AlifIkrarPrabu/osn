<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DiscussionTopic extends Model
{
    protected $fillable = ['classroom_id', 'user_id', 'title', 'content'];

    // Mengetahui siapa pembuat topik ini (Guru atau Siswa)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Mengetahui topik ini ada di kelas mana
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    // Mengambil semua komentar di dalam topik ini
    public function replies(): HasMany
    {
        return $this->hasMany(DiscussionReply::class);
    }
}