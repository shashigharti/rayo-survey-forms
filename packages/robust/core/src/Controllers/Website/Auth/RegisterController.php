<?php

namespace Robust\Core\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Robust\Core\Repositories\Website\UserRepository;
use Robust\Core\Repositories\Admin\DashboardRepository;
use Illuminate\Http\Request;

/**
 * Class RegisterController
 * @package Robust\Admin\Controllers\Website\Auth
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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * RegisterController constructor.
     * @param UserRepository $user
     */

    public function __construct(UserRepository $user, DashboardRepository $dashboard)
    {
        $this->middleware('guest');
        $this->user = $user;
        $this->dashboard = $dashboard;
        $this->events = [
            'user_created' => 'Robust\Core\Events\UserCreatedEvent',
        ];
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed']
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        return response()->json([
                    'message' => __('A fresh verification link has been sent to your email address.') . ". " . __('Before proceeding, please check your email for a verification link.'),
                    'status' => 'success'
        ], 201);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function create(array $data)
    {

        // create a user account
        $new_user = $this->user->store([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'user_name' => $data['email'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'token' => md5(uniqid(rand(), true))
        ]);
        \Log::info($new_user);
        // create dashboard data for the new user
        $this->dashboard->store([
            'name' => "{$data['first_name']} Dashboard",
            'slug' => str_slug("{$data['first_name']} Dashboard"),
            'description' => 'Main Dashboard',
            'is_default' => true,
            'user_id' => $new_user->id
        ]);
        if ($new_user) {
            $config = config('client.override_event_notifications');
            $event = $this->events['user_created'];
            // if overridding events does exists in configuration, raise that event.
            if(isset($config['user_created'])){
                $event = $config['user_created'];
            }
            $this->guard()->login($new_user);
            // Raise user created event
            event(new $event($new_user));
        }

        return $new_user;
    }
}
