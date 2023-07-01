<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\Event;
use App\Models\SaveEvent;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\V1\EventRequest;
use App\Http\Resources\V1\EventResource;
use App\Http\Requests\V1\EventSaveRequest;
use App\Http\Requests\V1\EventUpdateRequest;
use App\Models\User;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = request()->get('page', 1);
        $events = Event::latest('id')->paginate(10);

        return Cache::store('redis')->remember("events_page_$page", 3, fn() => EventResource::collection($events));
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

    public function save(EventSaveRequest $request)
    {
        SaveEvent::create([
            'user_id' => auth()->user()->id,
            'event_id' => $request->event_id
        ]);

    $user = User::find(auth()->user()->id);

    foreach ($user->events as $event) {
        $information = $event->event->information;
        dump($information);
    }
        return json_response(Response::HTTP_CREATED, 'Event has been saved successfully');
    }
}
