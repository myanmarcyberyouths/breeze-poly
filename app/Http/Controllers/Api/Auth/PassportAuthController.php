<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PassportAuthController extends Controller
{
    public function register(LoginRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully.'
        ]);
    }
}
