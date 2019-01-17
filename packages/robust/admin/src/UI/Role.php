<?php
namespace Robust\Admin\UI;

use Robust\Core\UI\Core\BaseUI;

/**
 * Class Role
 * @package Robust\Admin\UI
 */
class Role extends BaseUI
{

    /**
     * @var array
     */
    public $columns = [
        'name' => 'Name',
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => "admin.roles.edit",
                'permission' => 'admin.role.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => "admin.roles.destroy",
                'permission' => 'admin.role.delete'
            ]
        ]
    ];

    /**
     * @var array
     */
//    public $right_menu = [
//        'enable' => ['display_name' => 'Enable', 'url' => '#'],
//        'disable' => ['display_name' => 'Disable', 'url' => '#'],
//        'Delete' => ['display_name' => 'Delete', 'url' => '#'],
//    ];

    /**
     * @var array
     */
    public $left_menu = [
        'add' => ['display_name' => 'Add', 'url' => 'admin.roles.create', 'permission' => 'admin.role.add']
    ];

    public $addrules = [];

    public $editrules = [];

    /**
     * @param $role
     * @return array
     */
    public function getRoute($role)
    {
        return $role->exists ? ['admin.roles.update', $role->id] : ['admin.roles.store'];
    }

}
