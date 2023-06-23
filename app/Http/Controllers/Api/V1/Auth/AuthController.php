<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {

            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $data['date_of_birth'] = Carbon::parse($data['date_of_birth'])->format('Y-m-d');
            $data['username'] = 'user_' . time();

            $user = User::create($data);

            $user->addMediaFromBase64($data['profile_image'])
                ->toMediaCollection('profile-images');

            $user->interests()->attach($data['interests']);

            $token = $user->createToken('access_token')->accessToken;

            return json_response(Response::HTTP_CREATED, 'User has been created successfully', [
                'access_token' => $token,
            ]);
        } catch (\Exception $exception) {
            return json_response(Response::HTTP_INTERNAL_SERVER_ERROR, 'Something went wrong');
        }
    }

    public function login(LoginRequest $request)
    {
        $validatedUser = $request->validated();
        $auth = auth()->attempt($validatedUser);
        if (!$auth) {
            return json_response(Response::HTTP_UNPROCESSABLE_ENTITY, 'Invalid credentials');
        }

        $token = auth()->user()->createToken('access_token')->accessToken;

        return json_response(200, 'User has been logged in successfully', [
            'access_token' => $token,
        ]);

    }

    public function getAuthUser()
    {
        $user = auth()->user();
        $user->load('interests:id,name');
        return new UserResource($user);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        auth()->user()->interests()->detach();
        return \response()->noContent();
    }

}
