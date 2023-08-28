<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserUnFollowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        auth()->user()->unfollow($user);

        return response()->json([
            'message' => 'User unfollowed successfully'
        ]);
    }
}
