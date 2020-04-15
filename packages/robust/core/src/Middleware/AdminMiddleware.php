<?php

namespace Robust\Core\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Robust\Core\Models\User;

/**
 * Class AdminMiddleware
 * @package Robust\Admin\Middleware
 */
class AdminMiddleware
{

    /**
     * @var User
     */
    public $user;

    /**
     * AdminMiddleware constructor.
     * @param User $user
     * @internal param Guard $auth
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $role = $this->user->find(auth()->id())->roles()->where('name', 'admin')->first();
        $permission_values = json_decode($role->permissions);

        if (isset($permission_values->{$permission})) {
            return $next($request);
        }
        return redirect()->back()->with('message', 'You have no Permission at all');
    }
}
