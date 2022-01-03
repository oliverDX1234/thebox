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

        //Has to redirect like this because otherwise there is bug when logging in
        //then refreshing the page
        //then logging out and afterwards refreshing the page
        //instead of redirected to /admin/login
        //it redirects to /
        return redirect('/admin/login');

        return response()->json(['message' => 'Successfully logged out']);
    }
}
