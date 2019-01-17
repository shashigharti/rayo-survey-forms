<?php

namespace Robust\Core\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Robust\Admin\Models\User;
use Robust\Core\Models\NotificationToken;


/**
 * Class ImageController
 * @package Robust\Core\Controllers\API
 */
class NotificationController extends Controller
{
    /**
     * @param $id
     * @param $size
     * @return mixed
     */
    public function storeToken(Request $request)
    {
        $data = $request->all();
        $existing_token = NotificationToken::where('user_id', $data['user_id'])->where('token', $data['token'])->where('app', $data['app'])->first();
        if ($existing_token) {
            $existing_token->active = 1;
            $existing_token->update();
        } else {
            NotificationToken::create([
                'user_id' => $data['user_id'],
                'email' => $data['email'],
                'app' => $data['app'],
                'token' => $data['token'],
                'active' => 1
            ]);
        }
    }

    public function disableToken(Request $request)
    {
        $data = $request->all();
        $token = NotificationToken::where('user_id', $data['user_id'])->where('token', $data['token'])->where('app', $data['app'])->first();
        if ($token) {
            $token->active = 0;
            $token->update();
        }
    }

    public function getUserNotification(Request $request)
    {
        if ($request->has('user_id')) {
            $user = User::find($request->get('user_id'));
            return $user->notifications()->orderBy('created_at')->get();
        } else {
            $user = auth()->user();
            return $user->notifications()->orderBy('created_at')->limit(10)->get();
        }
    }

    public function markAsRead(Request $request)
    {
        if ($request->has('user_id'))
            $user = User::find($request->get('user_id'));
        else
            $user = auth()->user();

        $user->unreadNotifications()->update(['read_at' => Carbon::now()]);
    }
}
