<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EventResource;
use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\Event\EventCollection;

class LaunchedEventController extends Controller
{
    public function __invoke()
    {
        $events = auth()->user()->launchedEvents()
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return EventResource::collection($events);
    }
}
