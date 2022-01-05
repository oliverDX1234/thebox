<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        if (!auth()->attempt($credentials, $request->get('rememberMeInput'))) {
            return response()->json(['error' => 'Invalid email or password entered.'], 401);
        }

        return response()->json(['message' => 'Sucessfully logged in', 'user' => auth()->user()]);
    }

    public function me()
    {
        return auth()->user();
    }

    public function logout()
    {
        request()->session()->flush();
        request()->session()->invalidate();
        auth()->guard("web")->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
