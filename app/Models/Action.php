<?php

namespace App\Models;

use App\Enums\ActionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    protected $casts = [
        'type' => ActionType::class,
    ];
}
