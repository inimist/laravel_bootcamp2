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
            $userId = Auth::id();
            return response()->json(['userId' => $userId]);
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

        return response()->json(['userId' => $user->id]);
    }

    public function logout(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::logout()) {
            // Revoke the current user's access token
           // Auth::user()->tokens()->where('id', optional(Auth::user()->currentAccessToken())->id)->delete();

            // Perform the actual logout
            //Auth::logout();

            return response()->json(['message' => 'Successfully logged out']);
        }

        return response()->json(['message' => 'User not authenticated']);
    }
}
