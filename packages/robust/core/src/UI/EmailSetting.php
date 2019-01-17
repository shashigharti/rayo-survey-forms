<?php

namespace Robust\Core\UI;

use Robust\Core\UI\Core\BaseUI;
use Robust\Core\Models\EmailSetting as Model;


/**
 * Class EmailSetting
 * @package Robust\Core\UI
 */
class EmailSetting extends BaseUI
{
    /**
     * @var string
     */
    public $route_name = 'email-settings';

    public $columns = [
        'setting_name' => 'Setting Name',
        'email' => 'Email',
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => "admin.email-settings.edit",
                'permission' => 'core.email-settings.manage'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => "admin.email-settings.destroy",
                'permission' => 'core.email-settings.manage'
            ]
        ]
    ];

    public $left_menu = [
        'add' => [
            'display_name' => 'Add',
            'url' => 'admin.email-settings.create',
            'permission' => 'core.email-settings.manage'
        ]
    ];

    public $addrules = [
        'setting_name' => 'required',
        'event' => 'required',
        'email' => 'required',
    ];

    public function getRoute($model)
    {
        return $model->exists ? ['admin.email-settings.update', $model->id] : ['admin.email-settings.store'];
    }
}
