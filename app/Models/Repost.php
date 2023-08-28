<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Repost extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_event_id',
        'user_id',
        'content',
    ];


    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'original_event_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
