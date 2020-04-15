<?php
namespace Robust\Core\Helpers;

use Robust\Core\Models\Role;

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
        return Role::pluck('name', 'id')->toArray();
    }
}
