<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SuggestionController extends Controller
{
    public function __invoke(Request $request)
    {

        $events = Event::latest('id')->get()
            ->collect()
            ->map(function (Event $event) {
                return [
                    'id' => $event->id,
                    'content' => $event->title,
                ];
            });
        $interests = $request->user()->interests()
            ->latest('id')->get()
            ->collect()
            ->map(function ($interest) {
                return [
                    'id' => $interest->id,
                    'content' => $interest->name,
                ];
            });

        // request to the suggestion service
        $response = Http::suggestion()->post(
            '/suggestion',
            data: [
                'events' => $events,
                'interests' => $interests,
            ]
        );


        $suggestedEvents = collect($response->json())
            ->map(fn($suggestion) => $suggestion['event'])
            ->map(fn(array $event) => new EventResource(Event::find($event['id'])));


        return EventResource::collection($suggestedEvents);
    }
}
