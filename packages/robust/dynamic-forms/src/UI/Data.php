<?php

namespace Robust\DynamicForms\UI;

use Robust\Admin\Models\User;
use Robust\Core\UI\Core\BaseUI;

/**
 * Class Data
 * @package Robust\DynamicForms\UI
 */
class Data extends BaseUI
{
    /**
     * @var array
     */
    public $columns = [
        'callback' => 'User',
        'updated_at' => 'Submitted at',
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => 'admin.forms.data.show',
                'permission' => 'forms.data.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => 'admin.forms.data.destroy',
                'permission' => 'forms.data.delete'
            ],
        ]
    ];

    /**
     * @var array
     */
    public $right_menu = [
        'print' => [
            'display_name' => '<i aria-hidden="true" class="site-menu-icon md-print"></i> Print',
            'url' => 'admin.forms.data.print',
            'permission' => 'forms.data.print'
        ]
    ];

    /**
     * @param $params
     * @return string
     */
    public function getUser($params)
    {
        $user = User::find($params['user_id']);
        if ($user) {
            return $user->first_name . ' ' . $user->last_name;
        }

        return 'Guest';
    }
}
