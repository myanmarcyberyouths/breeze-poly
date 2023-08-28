<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventCommentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Event $event)
    {
//        $event->comments()->create([
//            'comment' => "Hello world 1",
//            'user_id' => auth()->id(),
//        ]);


        return response()->json(
            $event->comments()->get()->toTree()
        );
    }
}
