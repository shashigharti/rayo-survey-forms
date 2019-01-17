<?php
namespace Robust\Admin\Helpers;

use Robust\Admin\Models\Role;

/**
 * Class RoleHelper
 * @package Robust\Admin\Helpers
 */
class RoleHelper
{
    /**
     * @return array
     */
    public function roles()
    {
        $roles = Role::pluck('name', 'id');
        return $roles->toArray();
    }
}