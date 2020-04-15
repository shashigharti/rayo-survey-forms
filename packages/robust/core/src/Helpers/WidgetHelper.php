<?php

namespace Robust\Core\Helpers;

use Robust\Core\Models\User;

/**
 * Class WidgetHelper
 * @package Robust\Core\Helpers
 */
class WidgetHelper
{

    /**
     * @return int
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
        return User::all();
    }

}
