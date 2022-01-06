<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    public function reset(ResetPasswordRequest $request)
    {

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.

        $user = User::where("email", $request->email)->first();

        if (!$user) {
            return response()->api( "user.not_found", 400);
        }

        if (Hash::check($request->password, $user->password)) {
            return response()->api( "auth.password_must_be_different", 400);
        }


        $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse()
            : $this->sendResetFailedResponse();
    }

    /**
     * Reset the given user's password.
     *
     * @param CanResetPassword $user
     * @param string $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);
        //Here Larvel tries to set the "Remember me" cookie
        //$user->setRememberToken(Str::random(60));

        $user->save();
        event(new PasswordReset($user));
        //By default, Laravel will attempt to automatically log in the user
        //$this->guard()->login($user);
    }

    /**
     * Get the response for a successful password reset.
     *
     * @return JsonResponse
     */
    protected function sendResetResponse()
    {
        return response()->api(null, "auth.password_reset_success", 200);
    }

    /**
     * Get the response for a failed password reset.
     *
     * @return JsonResponse
     */
    protected function sendResetFailedResponse()
    {
        return response()->api(null, "auth.password_reset_failed", 422);
    }
}
