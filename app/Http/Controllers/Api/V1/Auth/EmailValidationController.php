<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\EmailRequest;
use Illuminate\Http\Request;

class EmailValidationController extends Controller
{
    public function validateEmail(EmailRequest $request)
    {
        return json_response(200, "Email is valid");
    }
}
