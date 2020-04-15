<?php
namespace Robust\Core\UI;

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
                'display_name' => '<i class="site-menu-icon material-icons">edit</i>',
                'url' => "admin.users.edit",
                'permission' => 'admin.user.edit'
            ],
            'delete' => [
                'display_name' => '<i class="site-menu-icon material-icons">delete</i>',
                'url' => "admin.users.destroy",
                'permission' => 'admin.user.delete'
            ]
        ]
    ];

    public $right_menu = [
        'add' => [
            'display_name' => 'Add', 'url' => 'admin.users.create', 'permission' => 'admin.user.add', 'icon' => 'add'
        ]
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

    /**
     * @return string
     */
    // public function getModel()
    // {
    //     return 'Robust\Admin\Models\Page';
    // }

     /**
     * @param array $row
     * @return string
     */
    public function getName($row)
    {
        $user = \Robust\Core\Models\User::find($row['id']);
        if(isset($row['avatar']))
            $img = $row['avatar'];
        else
            $img = \Avatar::create($user->memberable->first_name . ' ' . $user->memberable->last_name);
        return '<img src="' . $img . '" width="30" style="border-radius:100px">' . ' ' . $user->memberable->first_name . ' ' . $user->memberable->last_name . '</a>';
    }
}
