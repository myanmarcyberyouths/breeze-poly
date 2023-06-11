<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterRequest;

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

        $token = $user->createToken('API Token')->accessToken;

        return response()->json([
            'meta' => [
                'status' => 201,
                'msg' => 'New user has been created'
            ],
            'data' => [
                'token' => $token,
            ]
        ], Response::HTTP_CREATED);
    }
}
