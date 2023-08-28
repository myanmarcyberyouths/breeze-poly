<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
