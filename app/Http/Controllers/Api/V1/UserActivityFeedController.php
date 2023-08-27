<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserActivityFeedResource;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserActivityFeedController extends Controller
{
    public function __invoke()
    {

        // get the latest activity id for each event
        $latestActivities = Activity::selectRaw('MAX(id) as id')
            ->where('user_id', auth()->id())
            ->groupBy('event_id')
            ->get();


        // get the activities for the latest activity ids
        $activities = Activity::whereIn('id', $latestActivities->pluck('id'))
            ->with('user')
            ->with('action')
            ->with('event', function (BelongsTo $query) {
                $query->with('user');
            })
            ->latest('id')
            ->get();

        return response()->json(UserActivityFeedResource::collection($activities));
    }
}
