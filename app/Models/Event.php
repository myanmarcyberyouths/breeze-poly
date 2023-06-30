<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'date',
        'time',
        'place',
        'ticket_price',
        'information',
        'visibility',
        'is_shareable',
    ];

    protected $casts = [
        'is_shareable' => 'boolean',
    ];

}
