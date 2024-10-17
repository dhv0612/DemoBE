<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(compact('token'));
    }

    public function logout(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(['message' => 'Đăng xuất thành công.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Đăng xuất không thành công.'], 500);
        }
    }
}
