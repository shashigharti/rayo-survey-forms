<?php

namespace Robust\Core\Helpers;

use Robust\Admin\Models\User;
use Robust\Projects\Models\Project;
use Spatie\Analytics\Period;

/**
 * Class WidgetHelper
 * @package Robust\Core\Helpers
 */
class WidgetHelper
{
    /**
     * @return array
     */
    public function totalUsers()
    {
        return User::all()->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function recentUserActivity()
    {
        $users = User::all();
        return $users;
    }

}