<?php

namespace Robust\Core\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Admin\Repositories\Admin\UserRepository;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;

/**
 * Class UserController
 * @package Robust\Core\Controllers\API
 */
class UserController extends Controller
{
    use CrudTrait, ViewTrait;

    /**
     * UserController constructor.
     * @param Request $request
     * @param UserRepository $model
     */
    public function __construct(Request $request, UserRepository $model)
    {
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * @param UserRepository $user
     * @return mixed
     */
    public function users(UserRepository $user)
    {
        return $user->all();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function getUserInfo($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword($id)
    {
        $user = $this->model->find($id);

        $check = \Hash::check($this->request->get('old_password'), $user->password);
        if (!$check) {
            return response()->json(['status' => 0]);
        }

        $user->password = bcrypt($this->request->get('password'));
        $user->update();
        return response()->json(['status' => 1]);
    }

}
