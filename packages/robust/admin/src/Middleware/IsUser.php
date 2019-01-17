<?php

namespace Robust\Admin\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Robust\Admin\Models\User;

/**
 * Class AdminMiddleware
 * @package Robust\Admin\Middleware
 */
class IsUser
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
    public function handle($request, Closure $next)
    {
        if (Auth::user() && !Auth::user()->can('admin.view'))
            return $next($request);

        return redirect()->route('website.home');
    }
}