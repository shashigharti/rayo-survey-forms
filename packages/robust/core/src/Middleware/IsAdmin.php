<?php

namespace Robust\Core\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Robust\Core\Models\User;

/**
 * Class AdminMiddleware
 * @package Robust\Admin\Middleware
 */
class IsAdmin
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
        if (Auth::user() && isAdmin()){
            \Log::info("is admin " . Auth::user());
            return $next($request);
        }elseif(Auth::user() && !isAdmin()){
            \Log::info("is user " . Auth::user());
            return redirect()->route('website.user.profile');
        }

        return redirect()->route('website.home');
    }
}
