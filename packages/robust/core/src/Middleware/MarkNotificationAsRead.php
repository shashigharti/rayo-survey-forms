<?php

namespace Robust\Core\Middleware;

use Closure;
use Robust\Admin\Models\User;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Auth::user()){
            $user = User::find(\Auth::user()->id);
            if ($request->has('notification_id')) {
                $user->notifications()->where('id', $request->get('notification_id'))->first()->markAsRead();
            }
        }

        return $next($request);
    }
}
