<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class PassportAuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['date_of_birth'] = Carbon::parse($data['date_of_birth'])->format('Y-m-d');

        $user = User::create($data);
        $token = $user->createToken('access_token')->accessToken;

        return json_response(Response::HTTP_CREATED, 'User has been created successfully', [
            'access_token' => $token,
        ]);
    }

    public function login(LoginRequest $request)
    {
        $validatedUser = $request->validated();
        $auth = auth()->attempt($validatedUser);
        if (!$auth) {
            return json_response(Response::HTTP_UNPROCESSABLE_ENTITY, 'Invalid credentials');
        }

        $token = auth()->user()->createToken('access_token')->accessToken;

        return json_response(Response::HTTP_CREATED, 'User has been logged in successfully', [
            'access_token' => $token,
        ]);

    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return \response()->noContent();
    }
}
