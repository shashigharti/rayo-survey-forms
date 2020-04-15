<?php
namespace Robust\Admin\Policies;

/**
 * Class UserPolicy
 * @package Robust\Admin\Policies
 */
class UserPolicy
{

    /**
     * @return bool
     */
    public function update()
    {
        return true;
    }
}