<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        // Hash::check($pass, $user->pass)
        if (Auth::attempt($credentials)) {
            $user = auth()->user();

            return response([
                'token' => $user->createToken('api token')->plainTextToken,
                'user' => new UserResource($user)
            ]);
        }
        return response([
            'request' => $credentials
        ]);
    }
}
