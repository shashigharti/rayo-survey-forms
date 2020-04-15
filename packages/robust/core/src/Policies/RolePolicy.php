<?php

namespace Robust\Admin\Policies;

/**
 * Class RolePolicy
 * @package Robust\Admin\Policies
 */
class RolePolicy
{

    /**
     * @return bool
     */
    public function update()
    {
        return true;
    }
}