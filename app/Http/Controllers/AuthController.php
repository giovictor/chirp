<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only(['email','password']);

        try {
            if(!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Invalid email or password.'], 401);
            }
        } catch(JWTException $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

        return response()->json(['token' => $token], 200);
    }
}
