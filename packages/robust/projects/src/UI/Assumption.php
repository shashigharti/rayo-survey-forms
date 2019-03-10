<?php
namespace Robust\Projects\UI;

use Robust\Core\UI\Core\BaseUI;
use Robust\Projects\Models\Target;

/**
 * Class Indicator
 * @package Robust\Projects\UI
 */
class Assumption extends BaseUI
{
    public $route_name = 'projects.assumptions';

    /**
     * @var array
     */
    public $columns = [
        'assumption' => 'Assumption',
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => [
                    'callback' => 'getEditRoute'
                ],
                'permission' => 'forms.view'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => ['callback' => 'getDeleteRoute'],
                'permission' => 'forms.view'
            ]
        ]
    ];

    /**
     * @var array
     */
    public $addrules = [
        'assumption' => 'required',

    ];

}
