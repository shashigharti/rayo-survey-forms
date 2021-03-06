<?php

namespace Robust\Core\Helpers;

use Robust\Core\Models\Role;
use Robust\Core\Models\User;

/**
 * Class UserHelper
 * @package Robust\Admin\Helpers
 */
class UserHelper
{
    /**
     * @return array
     */
    public function getAdminUsers()
    {
        $role = Role::where('name', 'Administrator')
            ->first();
        return $role->users;
    }

    /**
     * @return array
     */
    public function getOtherUsers($user)
    {
        $users = User::where('id', '<>', $user->id)->get();
        return $users;
    }

    /**
     * @return array
     */
    public function getAllUsersL()
    {
        $users = User::pluck('first_name', 'id');
        return $users;
    }
}
