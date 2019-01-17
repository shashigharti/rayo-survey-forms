<?php
namespace Robust\Admin\UI;

use Robust\Core\UI\Core\BaseUI;

/**
 * Class User
 * @package Robust\Admin\UI
 */
class User extends  BaseUI
{

    /**
     * @var array
     */
    public $columns = [
        'Name' => ['callback' => 'Name'],
        'email' => 'Email',
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => "admin.users.edit",
                'permission' => 'admin.user.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => "admin.users.destroy",
                'permission' => 'admin.user.delete'
            ]
        ]
    ];
    /**
     * @var array
     */
//    public $right_menu = [
//        'enable' => ['display_name' => 'Enabled', 'url' => '#'],
//        'disable' => ['display_name' => 'Disabled', 'url' => '#'],
//        'deleted' => ['display_name' => 'Deleted', 'url' => '#'],
//    ];

    /**
     * @var array
     */
    public $left_menu = [
        'add' => ['display_name' => 'Add', 'url' => 'admin.users.create', 'permission' => 'admin.user.add']
    ];

    public $addrules = [
        'password_confirmation' => 'required | same:password'
    ];

    public $editrules = [];

     /**
     * @param $user
     * @return array
     */
    public function getRoute($user)
    {
        return $user->exists ? ['admin.users.update', $user->id] : ['admin.users.store'];
    }
    /**
     * @param $user
     * @return mixed
     */
    public function getSelectedRoles($user)
    {
        return $user->roles->pluck('id')->toArray();
    }

    public function getName($row)
    {
        if($row['avatar'] != '')
            $img = $row['avatar'];
        else
            $img = \Avatar::create($row['first_name'].' '.$row['last_name']);
        return '<img src="' . $img . '" width="30" style="border-radius:100px">' . ' ' . $row['first_name'].' '.$row['last_name'];
    }
}
