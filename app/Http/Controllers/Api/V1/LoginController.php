<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Resources\Api\V1\UserResource;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['phone', 'password']);

        if (auth()->attempt($credentials)) {
            $user = $request->user();
            
            // TODO: implement: change to .env
            $token = $user->createToken("DELIGHT_FB");

            return response()->success([
                "data" => [
                    "user" =>  new UserResource($user),
                    "token" => $token->plainTextToken
                ]
            ]);
        }

        return response()->error([
            'message' => 'Invalid credentials. Please try again.'
        ], 401);
    }
}
