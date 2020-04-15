<?php
namespace Robust\Core\Controllers\Admin;

use Robust\Core\Repositories\Admin\UserRepository;
use Robust\Core\Controllers\Common\Traits\CrudTrait;
use Robust\Core\Controllers\Common\Traits\ViewTrait;


/**
 * Class UserController
 * @package Robust\Admin\Controllers\Admin
 */
class UserController extends Controller
{
    use CrudTrait, ViewTrait;

    /**
     * UserController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->middleware('auth');
        $this->model = $user;
        $this->ui = 'Robust\Core\UI\User';
        $this->package_name = 'core';
        $this->view = 'admin.users';
        $this->title = 'Users';
        $this->events = [
            'store' => 'Robust\Core\Events\UserCreatedEvent',
        ];
    }

}
