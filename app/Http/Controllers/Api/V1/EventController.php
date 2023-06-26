<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\EventRequest;
use App\Http\Requests\V1\EventUpdateRequest;
use App\Http\Resources\V1\EventResource;
use App\Models\Event;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::latest()->paginate(5);
        return Cache::store('redis')->remember('events', 60, function () use ($events) {
            return EventResource::collection($events);
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $data = $request->validated();
        $data['date'] = date('Y-m-d', strtotime($data['date']));
        $data['time'] = date('H:i:s', strtotime($data['time']));

        $event = Event::create($data);
        $event->addMediaFromBase64($data['image'])
            ->toMediaCollection('event-images');

        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return Cache::store('redis')->remember('event', 60, function () use ($event) {
            return new EventResource($event);
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventUpdateRequest $request, Event $event)
    {
        $data = $request->validated();
        $data['date'] = date('Y-m-d', strtotime($data['date']));
        $data['time'] = date('H:i:s', strtotime($data['time']));

        $event->update($data);

        if (isset($data['image'])) {
            $event->clearMediaCollection('event-images');
            $event->addMediaFromBase64($data['image'])
                ->toMediaCollection('event-images');
        }

        return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        Cache::delete('event');
        return response()->noContent();
    }
}
