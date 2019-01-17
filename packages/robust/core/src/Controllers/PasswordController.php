<?php

namespace Robust\Core\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Robust\Admin\Models\User;
use Robust\Core\Helpage\Site;

/**
 * Class PasswordController
 * @package Robust\Core\Controllers
 */
class PasswordController extends Controller
{
    /**
     * PasswordController constructor.
     */
    public function __construct()
    {
        $this->middleware('user');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRequestPassword()
    {
        return view(Site::templateResolver('core::website.forms.password-request'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRequestPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required | min:6',
            'password_comfirmation' => 'required | same:password'
        ]);

        $user = User::find(\Auth::user()->id);
        if (!Hash::check($request['old_password'], $user->password)) {
            return back()
                ->with('error', 'Old Password Does Not Match');
        }
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect()->route('robust.website.user.profile')->with('message', 'Password Updated Successfully');

    }
}
