<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{

    use SendsPasswordResetEmails;


    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255'],
        ]);
//        TODO review if we want more specific messages (handling laravel validations)
        if ($validator->fails()) {
            return response()->api(null, "auth.account_reset_failed", 422);
        }

        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse()
            : $this->sendResetLinkFailedResponse($response);
    }

    protected function sendResetLinkResponse()
    {
        return response()->api(null, "auth.account_reset_email_sent", 200);
    }

    protected function sendResetLinkFailedResponse($response)
    {
        return response()->api(null, $response, 422);
    }
}
