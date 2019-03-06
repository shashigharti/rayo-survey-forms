<?php
namespace Robust\Admin\Controllers\Website;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Robust\Admin\Repositories\Website\RegisterRepository;
use Robust\Core\Controllers\Admin\Controller;

/**
 * Class UserController
 * @package Robust\Admin\Controllers\Admin
 */
class RegisterController extends Controller
{
    /**
     * UserController constructor.
     * @param UserRepository $user
     */
    public function __construct(RegisterRepository $user, Request $request)
    {
        $this->model = $user;
        $this->request = $request;
        $this->events = [
            'create' => 'Robust\Core\Events\UserCreatedEvent',
        ];
    }

    public function postRegister()
    {
        $this->validate($this->request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required| unique:users',
            'password' => 'required | min:5',
            'confirm_pass' => 'same:password'
        ]);
        $user = $this->model->store($this->request->all());
        if ($user) {
            $event = $this->events['create'];
            event(new $event($user));
            Auth::attempt(['email' => $this->request->get('email'), 'password' => $this->request->get('password')]);
        }
        if (\Cache::get('redirect_url')) {
            $redirect_url = \Cache::get('redirect_url');
        }
        if (isset($redirect_url)) {
            return redirect($redirect_url);
        }
        return redirect()->route('website.home')->with('message', 'Account created successfully');
    }

}
