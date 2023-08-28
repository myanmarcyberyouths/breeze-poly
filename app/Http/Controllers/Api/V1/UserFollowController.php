<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserFollowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        auth()->user()->follow($user);

        return response()->json([
            'message' => 'User followed successfully'
        ]);
    }
}
