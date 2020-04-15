<?php

namespace Robust\Core\Controllers\Admin;

use Robust\Core\Repositories\Admin\RoleRepository;
use Robust\Core\Controllers\Common\Traits\CrudTrait;
use Robust\Core\Controllers\Common\Traits\ViewTrait;


/**
 * Class RoleController
 * @package Robust\Admin\Controllers\Admin
 */
class RoleController extends Controller
{
    use CrudTrait, ViewTrait;

    /**
     * RoleController constructor.
     * @param RoleRepository $role
     */
    public function __construct(RoleRepository $role)
    {
        $this->middleware('auth');
        $this->model = $role;
        $this->ui = 'Robust\Core\UI\Role';
        $this->package_name = 'core';
        $this->view = 'admin.roles';
        $this->title = 'Roles';
    }

}
