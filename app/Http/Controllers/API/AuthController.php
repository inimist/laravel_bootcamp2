<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); //this way we get whole user data
            // $userId = Auth::id(); this way we get user id.
            $token = Auth::user()->createToken('auth_token')->plainTextToken;
            return response()->json(['token' => $token, 'userData' => $user]);
        }

        return response()->json('invalid credential');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json(['userId' => $user->id, 'token' => $token]);
    }

    public function logout(Request $request)
    {
        // Revoke the user's current access token
        $request->user()->tokens()->delete();
        return response()->json(['success']);
    }
}
