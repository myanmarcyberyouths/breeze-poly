<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Event;

class CommentLikeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Event $event, Comment $comment)
    {
        auth()->user()->favorite($comment);

        return response()->json([
            'message' => 'Comment liked successfully',
            'data' => $comment->favoriters()->count()
        ]);
    }
}
