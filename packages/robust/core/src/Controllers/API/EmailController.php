<?php

namespace Robust\Core\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Admin\Helpers\UserHelper;
use Robust\Core\Helpage\Site;

class EmailController extends Controller
{

    public function sendEmail(Request $request)
    {
        $data = $request->all();
        $users = with(new UserHelper())->getAdminUsers();

        foreach ($users as $user) {
            \Mail::send(Site::templateResolver('core::admin.emails.api_contact'), $data, function ($message) use ($user, $data) {
                $message->from($data['email']);
                $message->to($user->email);
                $message->subject($data['subject']);
            });
        }
        return response()->json(['status', true]);
    }
}
