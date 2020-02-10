<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ])) {
            $user = auth()->user();
            $user->api_token = Str::random(60);
            $user->save();
            return $user;
        }
        return "no";
    }

    public function logout(Request $request)
    {
        if (auth()->user()) {
            $user = auth()->user();
            $user->api_token = null;
            $user->save();
            return response()->json(['message' => 'Thank You!']);;
        }
        return response()->json([
            'error' => 'Unable to logout user',
            'code' => 401
        ], 401);
    }
}
