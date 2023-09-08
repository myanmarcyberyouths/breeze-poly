<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\V1\EventRequest;
use App\Http\Requests\V1\EventUpdateRequest;
use App\Http\Resources\V1\EventResource;
use App\Models\Event;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $page = request()->get('page', 1);
//        $events = Event::with('user')->latest()->paginate(5);
//        return Cache::remember("events_page_$page", 3, fn() => EventResource::collection($events));

        $events = auth()
            ->user()
            ->followings()
            ->with(
                'followable',
                fn(Builder $builder) => $builder->with(
                    'activities',
                    fn(Builder $builder) => $builder->with('action')
                        ->with('user')
                        ->with('event', function (BelongsTo $query) {
                            return $query
                                ->with('user')
                                ->with('repost', function (HasOne $query) {
                                    return $query->with(
                                        'event',
                                        fn(BelongsTo $query) => $query->with('user')
                                    );
                                });
                        })
                        ->latest('id')
                )
            )
            ->get();
        $mapped = collect($events)->map(function ($item) {
            return $item['followable']['activities'];
        })->flatten(1)->sortByDesc('id')->values();

        return response()->json($mapped);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {

        $data = $request->validated();
        $data['date'] = date('Y-m-d', strtotime($data['date']));
        $data['time'] = date('H:i:s', strtotime($data['time']));
        $data['user_id'] = auth()->user()->id;

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
        return Cache::remember("event_$event->id", 60, fn() => new EventResource($event));
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
        Cache::delete("event_$event->id");
        return response()->noContent();
    }

}
