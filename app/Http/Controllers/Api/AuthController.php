<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $user = User::where('email', $credentials['email']);

        if (!$user) {
            return response([
                'message' => 'user not found'
            ],404);
        }

        if (Hash::check($credentials['password'], $user->password)) {
            return new UserResource($user);
        }

        return response()->json([
            'message' => 'password not valid'], 400);

    }
}
