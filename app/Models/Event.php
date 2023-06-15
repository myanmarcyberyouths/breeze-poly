<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'image',
        'time',
        'place',
        'price',
        'about',
        'visibility',
        'date',
    ];
}
