<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Overtrue\LaravelLike\Traits\Likeable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Likeable;


    protected $fillable = [
        'title',
        'date',
        'time',
        'place',
        'ticket_price',
        'information',
        'visibility',
        'is_shareable',
        'user_id',
    ];

    protected $casts = [
        'is_shareable' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function repost(): HasOne
    {
        return $this->hasOne(Repost::class, 'original_event_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }


}
