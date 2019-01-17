<?php

namespace Robust\Core\Controllers;

use Robust\Core\Controllers\Admin\Controller;
use Robust\Core\Helpage\Site;

/**
 * Class LoginController
 * @package Robust\Core\Controllers
 */
class LoginController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('core::auth.login');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register()
    {
        return view('core::auth.register');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function forgot_password()
    {
        return view(Site::templateResolver('core::website.forms.forgot-password'));
    }
}