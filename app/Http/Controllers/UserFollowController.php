<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
