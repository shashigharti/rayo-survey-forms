<?php
namespace Robust\Admin\Controllers\Admin\API;

use Robust\Admin\Models\Role;
use Robust\Core\Controllers\Admin\Controller;

/**
 * Class RoleController
 * @package Robust\Admin\Controllers\Admin\API
 */
class RoleController extends Controller
{
    /**
     * @return array
     */
    public function getAllRoles()
    {
        $roles = Role::all();
        return json_encode($roles);
    }


}