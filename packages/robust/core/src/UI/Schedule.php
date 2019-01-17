<?php

namespace Robust\Core\UI;

use Robust\Core\UI\Core\BaseUI;
use Robust\Core\UI\Traits\CommonTrait;
use Robust\Core\UI\Traits\RouteTrait;

class Schedule extends BaseUI
{
    use RouteTrait, CommonTrait;

    public $route_name = 'schedules';


    public $columns = [
        'command' => 'Command',
        'interval' => 'Interval',
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => "admin.schedules.edit",
                'permission' => 'core.schedules.manage'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => "admin.schedules.destroy",
                'permission' => 'core.schedules.manage'
            ]
        ]

    ];
    public $left_menu = [
        'add' => ['display_name' => 'Add', 'url' => 'admin.schedules.create', 'permission' => 'core.schedules.manage'],

    ];

    /**
     * @var array
     */
    public $addrules = [
        'command' => 'required',
        'interval' => 'required|not_in:0',
    ];

}
