<?php

namespace Robust\Admin\Repositories\Admin;

use Robust\Core\Models\Permission;

/**
 * Class PermissionRepository
 * @package Robust\Admin\Repositories\Admin
 */
class PermissionRepository
{

    /**
     * @var Permission
     */
    private $permission;


    /**
     * PermissionRepository constructor.
     * @param Permission $permission
     */
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }
}
