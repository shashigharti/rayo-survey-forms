<?php
namespace Robust\Core\Controllers\Admin\Auth;

use App\Notifications\RegistrationNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Robust\Admin\Models\User;
use Robust\Admin\Repositories\Admin\UserRepository;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

/**
 * Class RegisterController
 * @package Robust\Core\Controllers\Admin\Auth
 */
class RegisterController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';


    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
//    protected function create(UserRepository $user, array $data)
//    {
//        $user = $user->store($data);
//        $user->notify(new RegistrationNotification());
//
//        return $user;
//    }

    protected function create(Request $request)
    {
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        return redirect()->route('frw.user.login')->with('success', 'You have successfully registered');
    }
}
