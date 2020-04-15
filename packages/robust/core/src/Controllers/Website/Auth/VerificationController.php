<?php

namespace Robust\Core\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Robust\Admin\Repositories\Website\UserRepository;
use Illuminate\Support\Carbon;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = 'website.user.profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Overrriden function.
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(UserRepository $user, Request $request)
    {
        $user = $user->where('token', $request->route('id'))->first();
        if($user->token == $request->route('id')){
            $user->update([
                'email_verified_at' => Carbon::now()
            ]);
        }
        //Auth::login($user);

        return redirect()->route($this->redirectTo)->with('verified', true);
    }

}
