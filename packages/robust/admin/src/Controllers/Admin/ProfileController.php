<?php
namespace Robust\Admin\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Admin\Models\User;
use Robust\Admin\Repositories\Admin\ProfileRepository;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Illuminate\Support\Facades\Hash;
use Robust\Core\Events\UserUpdatedEvent;

/**
 * Class ProfileController
 * @package Robust\Core\Controllers
 */
class ProfileController extends Controller
{
    use ViewTrait, CrudTrait;

    /**
     * ProfileController constructor.
     * @param ProfileRepository $profile
     */
    public function __construct(ProfileRepository $profile)
    {
        $this->middleware('auth');

        $this->model = $profile;
        $this->ui = 'Robust\Admin\UI\Profile';
        $this->package_name = 'admin';
        $this->view = 'admin.users.profile';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, $slug)
    {
        $profile = $this->model->find($id);

        return $this->display("{$this->package_name}::{$this->view}.create", [
                'model' => $profile,
                'slug' => $slug
            ]
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id, $slug)
    {
        $all_data = $request->all();
        $data = $request->except('files');

        if (isset($all_data['files'])) {
            foreach ($all_data['files'] as $key => $file) {
                $name = str_replace(' ', '-', strtolower($file->getClientOriginalName()));
                $imageName = $name;
                $file->move(public_path('uploads'), $imageName);
                $data[$key] = url('/uploads') . "/" . $imageName;
            }
        }

        if (isset($data['password'])) {
            $this->validate($request, [
                'password_confirmation' => 'same:password'
            ]);
            $record = $this->model->find($id);

            if (!Hash::check($data['current_password'],$record->password)) {
                return redirect(route("admin.profile.settings.edit", [$id, $slug]))->with('error', 'Current password is incorrect');

            }
        }
        $this->model->update($data, $id);

        //Raise event for profile update
        $user = User::find($id);
        event(new UserUpdatedEvent($user));

        return redirect(route("admin.profile.settings.edit", [$id, $slug]))->with('message', 'Record Updated Successfully');
    }
}