<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\UserResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(){
        return response()->success([
            "data" => new UserResource(auth()->user())
        ]);
    }
}
