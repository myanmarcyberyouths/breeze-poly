<?php

namespace App\Http\Controllers\Api\V1\Timeline;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function __invoke(Request $request)
    {
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
}
