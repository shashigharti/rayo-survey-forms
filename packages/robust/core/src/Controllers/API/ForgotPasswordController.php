<?php

namespace Robust\Core\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{

    use SendsPasswordResetEmails;

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );


        if ($response == Password::RESET_LINK_SENT) {
            return response()->json(['status' => true, 'message' => trans(Password::RESET_LINK_SENT)]);
        } else {
            return response()->json(['status' => false, 'message' => trans($response)]);
        }

    }


}
