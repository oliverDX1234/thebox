<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request): Response
    {
        $credentials = $request->only(['email', 'password']);

        if (!auth()->attempt($credentials, $request->get('rememberMeInput'))) {
            throw new ApiException("credentials_not_valid", 401);
        }

        return response()->api(['user' => auth()->user()], "login_successful");
    }

    public function me(): Response
    {
        return response()->api(['user' => auth()->user()], "authenticated_user_retrieved");
    }

    public function logout(): Response
    {
        try {
            request()->session()->flush();
            request()->session()->invalidate();
            auth()->guard("web")->logout();
        } catch (\Exception $e) {
            throw new ApiException("user_logout_failure", 500, null, $e);
        }

        return response()->api(null, "user_logout_success");
    }
}
