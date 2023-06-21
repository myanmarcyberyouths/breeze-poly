<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\IntrestResource;
use App\Models\Intrest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    public function index()
    {
        $intrests = Intrest::all();

        return IntrestResource::collection($intrests);
    }
}
