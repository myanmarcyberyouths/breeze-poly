<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\JsonResponse;

class EventDisLikeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Event $event)
    {
        auth()->user()->unfavorite($event);
        return new JsonResponse([
            'message' => 'Event disliked successfully',
            'data' => $event->favoriters()->count()
        ]);
    }
}
