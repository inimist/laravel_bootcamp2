<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); //this way we get whole user data
            $token = $user->createToken('Api Auth Token')->accessToken;
            return response(['token' => $token, 'user' => $user]);
        }

        return response(['error' => 'Login request failed'], 422);
    }

    public function signup(RegisterRequest $request)
    {
        try {
            $data = $request->validated();
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
            $token = $user->createToken('Api Auth Token')->accessToken;
            return response(['user' => $user, 'token' => $token]);
        } catch (\Exception $e) {
            return response(['error' => sprintf("Error while signing up. Error: %s", $e->getMessage())]);
        }
    }

    public function logout(Request $request)
    {
        // Revoke the user's current access token
        $request->user()->tokens()->delete();
        return response()->json(['success']);
    }

    public function updatePassword(Request $request)
    {
        try {
            $data = $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:8',
            ]);

            // Fetch the user by email (or any other unique identifier)
            $user = Auth::user();
            // Check if the user exists and the old password matches
            if ($user && Hash::check($data['old_password'], $user->password)) {

                // Update the password
                $user->password = $data['new_password'];
                $user->save();

                return response(['message' => 'Password updated successfully.']);
            } else {
                return response(['error' => 'Old password does not match.'], 422);
            }
        } catch (\Exception $e) {
            return response(['error' => sprintf("Error while updating password. Error: %s", $e->getMessage())], 500);
        }
    }
}
