<?php

namespace Robust\Admin\Controllers\Admin;

use Robust\Admin\Repositories\Admin\RoleRepository;
use Robust\Core\Controllers\Admin\Controller;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Helpers\MenuHelper;


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
        $this->ui = 'Robust\Admin\UI\Role';
        $this->package_name = 'admin';
        $this->view = 'admin.roles';
        $this->title = 'Roles';

    }

    public function index()
    {
        $records = $this->model->paginate();
        return $this->display('core::admin.layouts.sub-layouts.table',
            [
                'records' => $records,
                'primary_menu' => (new MenuHelper())->getPrimaryMenu($this->package_name),
                'title' => (isset($this->title)) ? $this->title : '',

                'default_data' => false,
                'package' => $this->package_name,
                'view' => $this->view
            ]
        );
    }

}