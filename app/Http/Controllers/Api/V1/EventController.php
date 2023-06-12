<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\EventRequest;
use App\Http\Resources\V1\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPUnit\Event\EventCollection;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::paginate();
        return EventResource::collection($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $newEvent = $request->validated();

        $imageUrl = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid()->toString() . '.' . $extension;
            $imageUrl = Storage::putFileAs('public/images', $file, $filename);
            $imageUrl = asset(Storage::url($imageUrl));
        }

        $newEvent['image'] = $imageUrl;

        $event = Event::create($newEvent);

        return (new EventResource($event))
            ->additional([
                'meta' => [
                    'status' => 201,
                    'msg' => 'Event has been created successfully',
                ]
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        $data = $request->validated();

        $imageUrl = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid()->toString() . '.' . $extension;
            $imageUrl = Storage::putFileAs('public/images', $file, $filename);
            $imageUrl = asset(Storage::url($imageUrl));
        }

        $updatedEvent = [
            ...$data,
            'image' => $imageUrl === '' ? $data['image_url'] : $imageUrl,
        ];

        $event->update($updatedEvent);

        return response()->json([
            'meta' => [
                'status' => 200,
            ],
            'msg' => 'Event has been updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->noContent();
    }
}
