<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials) == false) {
            return response()->json([
                'message' => 'Provided email address or password is incorrect.'
            ], 401);
        }
        /**@var User $user */
        $user = Auth::user();
        $user->tokens()->delete(); // Remove all previous tokens
        $token = $user->createToken('token')->plainTextToken;
        return response()->json(['token' => $token, 'user' => $user]);
    }
    public function signup(SignupRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $token = $user->createToken('token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user], 201);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully'], 204);
    }
}
