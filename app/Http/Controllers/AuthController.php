<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return response()->json(['error' => 'Invalid email or password entered.'], 401);
        }

        return response()->json(['message' => 'Sucessfully logged in', 'user' => auth()->user()]);
    }


    public function logout()
    {
//        TODO review impl
        try {
            Session::flush();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Problem during logout']);
        }

        return response()->json(['message' => 'Successfully logged out']);
    }
}
