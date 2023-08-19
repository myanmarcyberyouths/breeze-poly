<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EventResource;

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
