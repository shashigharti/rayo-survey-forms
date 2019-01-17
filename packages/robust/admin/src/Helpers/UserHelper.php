<?php

namespace Robust\Admin\Helpers;

use Robust\Admin\Models\Role;
use Robust\Admin\Models\User;

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