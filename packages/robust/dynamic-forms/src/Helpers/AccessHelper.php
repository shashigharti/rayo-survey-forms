<?php
namespace Robust\DynamicForms\Helpers;
use Robust\Admin\Models\User;

/**
 * Class AccessHelper
 * @package Robust\DynamicForms\Helpers
 */
class AccessHelper
{
    /**
     * @return bool
     */
    public static function isAdminUser()
    {
        if (\Auth::user()) {
            $user = User::find(\Auth::user()->id);
            return ($user->id == 1);
        }

        return false;
    }
}