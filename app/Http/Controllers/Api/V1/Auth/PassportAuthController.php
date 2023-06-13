<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class PassportAuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $dateOfBirth = \DateTime::createFromFormat('d/m/Y', $request->date_of_birth)->format('Y-m-d');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
            'password_confirmation'  =>  Hash::make($request->input('password_confirmation')),
            'date_of_birth' => $dateOfBirth,
            'pronoun' => $request->pronoun,
        ]);

        $token = $user->createToken('api token')->accessToken;

        return json_response(Response::HTTP_CREATED, 'User has been created successfully', [
            'token' => $token,
        ]);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {

            if (Hash::check($request->password, $user->password)) {

                $token = $user->createToken('api token')->accessToken;

                return json_response(Response::HTTP_OK, 'User has logged in successfully', [
                    'token' => $token,
                ]);

            }
        }
    }
}
