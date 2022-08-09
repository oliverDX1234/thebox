<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Response;
use Session;

class AuthController extends Controller
{
    /**
     * @throws ApiException
     */
    public function login(LoginRequest $request): Response
    {
        $credentials = $request->only(['email', 'password']);

        if (!auth()->attempt($credentials, $request->get('rememberMeInput'))) {
            throw new ApiException("auth.credentials_not_valid", 401);
        }

        return response()->api(['user' => auth()->user()], "auth.successful");
    }

    public function me(): Response
    {
        return response()->api(['user' => auth()->user()], "user.retrieved");
    }

    /**
     * @throws ApiException
     */
    public function logout(): Response
    {
        try {
            Session::flush();
        } catch (\Exception $e) {
            throw new ApiException("auth.logout_failure", 500, null, $e);
        }

        return response()->api(null, "auth.logout_success");
    }
}
