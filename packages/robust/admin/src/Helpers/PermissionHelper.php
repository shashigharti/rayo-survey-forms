<?php
namespace Robust\Admin\Helpers;

use Robust\Admin\Models\User;
use Robust\Admin\UI\Role;

/**
 * Class PermissionHelper
 * @package Robust\Core\Helpers
 */
class PermissionHelper
{
    public function check_permission($user, $action)
    {
        $user = User::find($user->id);
        $roles = $user->roles;
        $permissions = [];
        foreach ($roles as $role) {
            $permissions = $permissions + array_column($role->permissions->toArray(), 'name');
        }
        return in_array($action, $permissions);
    }
}