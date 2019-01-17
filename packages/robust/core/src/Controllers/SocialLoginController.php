<?php

namespace Robust\Core\Controllers;

use Illuminate\Support\Facades\Auth;
use Robust\Admin\Models\User;
use Robust\Core\Controllers\Admin\Controller;
use Laravel\Socialite\Facades\Socialite;
use Robust\Core\Helpage\Site;

/**
 * Class SocialLoginController
 * @package Robust\Core\Controllers
 */
class SocialLoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->fields([
            'first_name', 'last_name', 'email', 'gender', 'birthday'
        ])->scopes([
            'email', 'user_birthday'
        ])->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $redirect_url = \Cache::get('facebook_redirect');
        \Cache::forget('facebook_redirect');


        try {
            $user = Socialite::driver('facebook')->user();

        } catch (\Exception $e) {
            return redirect()->route('robust.website.user.login');
        }
        $result = $this->postLoginRegister($user);
        if ($result) {
            if (isset($redirect_url)) {
                return redirect($redirect_url);
            }
            return redirect()->route('website.home');
        } else {
            return view(Site::templateResolver('core::website.forms.login'));
        }
    }

    /**
     * @param $user
     * @return bool
     */
    public function postLoginRegister($user)
    {
        if ($user->getEmail()) {
            $auth_user = User::firstOrCreate([
                'email' => $user->getEmail(),
            ]);
        } elseif ($user->getId()) {
            $auth_user = User::firstOrCreate([
                'social_id' => $user->getId(),
            ]);
        } else {
            $auth_user = User::create([
                'email' => null
            ]);
        }

        $auth_user->first_name = $user->getName();
        $auth_user->avatar = $user->getAvatar();
        $auth_user->gender = $user->user['gender'];
        $auth_user->social_id = $user->getId();
        $auth_user->save();

        if (Auth::loginUsingId($auth_user->id, true)) {
            return true;
        }
        return false;

    }
}