<?php
namespace Robust\Core\UI;

use Robust\Core\UI\Core\BaseUI;


/**
 * Class Dashboard
 * @package Robust\Core\UI
 */
class Command extends BaseUI
{
    public $columns = [
        'name' => 'Command Name',
        'options' => [
            'run' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Run',
                'url' => "admin.commands.run",
                'permission' => 'core.commands.run'
            ],

        ]
    ];

}
