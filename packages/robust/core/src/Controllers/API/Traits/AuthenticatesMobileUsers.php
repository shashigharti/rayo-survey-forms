<?php

namespace Robust\Core\Controllers\API\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Robust\Admin\Helpers\PermissionHelper;
use Robust\Admin\Models\User;

/**
 * Class AuthenticatesMobileUsers
 * @package Robust\Core\Controllers\API\Traits
 */
trait AuthenticatesMobileUsers
{
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        if ($this->attemptLogin($request)) {
            $user = User::where('email', $request->get('email'))->first();
            $permissions = with(new PermissionHelper())->check_permission($user);
            $user['permissions'] = $permissions;

            if ($request->has('permission') && !$user->can($request->get('permission'))) {
                return response()->json(['status' => 2, 'message' => 'Access Denied!!']);
            } else
                return response()->json(['status' => 1, 'message' => 'Successfully Logged in!', 'data' => [$user]]);
        }

        return response()->json(['status' => 5, 'message' => 'Unable to login!']);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

}
