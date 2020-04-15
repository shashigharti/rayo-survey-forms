<?php
namespace Robust\Core\Controllers\Website;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Robust\Core\Models\User;
use Robust\Core\Repositories\Website\UserRepository;
use Robust\Core\Helpage\Site;

/**
 * Class ProfileController
 * @package Robust\Core\Controllers\Website
 */
class ProfileController extends Controller
{

    /**
     * ProfileController constructor.
     * @param UserRepository $user
     * @param Request $request
     */
    public function __construct(UserRepository $user, Request $request)
    {
        $this->model = $user;
        $this->request = $request;
        $this->events = [
            'update' => 'Robust\Core\Events\UserUpdatedEvent'
        ];

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('core::website.user-profile.index', ['user' => \Auth::user()->memberable]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProfile()
    {
        $user = Auth::user();
        return view(Site::templateResolver('admin::website.member.profile'), compact('user'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile()
    {
        $user = User::find(Auth::user()->id);
        $model = $user->update($this->request->except('_token'));
        $event = $this->events['update'];
        event(new $event($user));
        return redirect()->back()->with('message', 'Profile Updated');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
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
