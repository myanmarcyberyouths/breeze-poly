<?php

namespace App\Http\Controllers\Api\V1\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PublicTimelineController extends Controller
{
    public function __invoke(Request $request)
    {
        $page = request()->get('page', 1);
        $events = Event::with('user')->latest()->paginate(5);
        return Cache::remember("events_page_$page", 3, fn() => EventResource::collection($events));

    }
}
