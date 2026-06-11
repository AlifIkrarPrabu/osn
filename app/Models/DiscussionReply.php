<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiscussionReply extends Model
{
    protected $fillable = ['discussion_topic_id', 'user_id', 'content'];

    // Mengetahui siapa yang memberikan komentar ini
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Mengetahui komentar ini merujuk ke topik yang mana
    public function topic(): BelongsTo
    {
        return $this->belongsTo(DiscussionTopic::class, 'discussion_topic_id');
    }
}