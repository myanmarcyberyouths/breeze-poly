<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\EmailRequest;
use App\Http\Requests\V1\Auth\ProfileImageRequest;
use Illuminate\Http\Response;

class EmailValidationController extends Controller
{
    public function validateEmail(EmailRequest $request)
    {
        return json_response(Response::HTTP_OK, 'Email is valid');
    }

    public function validateProfileImage(ProfileImageRequest $request)
    {
        return json_response(Response::HTTP_OK, "Profile image is valid");
    }
}
