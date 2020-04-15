<?php
namespace Robust\Core\UI;

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
                 'display_name' => '<i class="site-menu-icon material-icons">edit</i>',
                'url' => "admin.roles.edit",
                'permission' => 'admin.role.edit'
            ],
            'delete' => [
                'display_name' => '<i class="site-menu-icon material-icons">delete</i>',
                'url' => "admin.roles.destroy",
                'permission' => 'admin.role.delete'
            ]
        ]
    ];

    /**
     * @var array
     */
    public $right_menu = [
        'add' => ['display_name' => 'Add', 'url' => 'admin.roles.create', 'permission' => 'admin.role.add', 'icon' => 'add']
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
