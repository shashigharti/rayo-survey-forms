<?php
namespace Robust\Admin\Controllers\Website;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Robust\Admin\Models\User;
use Robust\Admin\Repositories\Website\RegisterRepository;
use Robust\Core\Controllers\Admin\Controller;
use Robust\Core\Helpage\Site;

/**
 * Class UserController
 * @package Robust\Admin\Controllers\Admin
 */
class ProfileController extends Controller
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
            'update' => 'Robust\Core\Events\UserUpdatedEvent'
        ];

    }

    public function getProfile()
    {
        $user = Auth::user();
        return view(Site::templateResolver('core::website.member.profile'), compact('user'));
    }

    public function updateProfile()
    {
        $user = User::find(Auth::user()->id);
        $model = $user->update($this->request->except('_token'));
        $event = $this->events['update'];
        event(new $event($user));
        return redirect()->back()->with('message', 'Profile Updated');
    }

    public function updateAvatar()
    {
        $avatar = $this->request->file('avatar');

        $name = str_replace(' ', '-', strtolower($avatar->getClientOriginalName()));
        $imageName = $name;
        $avatar->move(public_path('uploads'), $imageName);

        $avatar = url('/uploads') . "/" . $imageName;

        $user = User::find(Auth::user()->id);
        $user->avatar = $avatar;
        $user->save();
        $event = $this->events['update'];
        event(new $event($user));
        return redirect()->back()->with('message', 'Avatar Changed');
    }
}
