<?php
namespace Robust\Projects\UI;

use Robust\Core\UI\Core\BaseUI;
use Robust\Projects\Models\Group;
use Robust\Projects\Models\Outcomes as Model;

/**
 * Class Outcome
 * @package Robust\Projects\UI
 */
class Outcome extends BaseUI
{

    /**
     * @var string
     */
    public $route_name = 'projects.outcomes';
    
    /**
     * @var bool
     */
    public $isModal = true;
    
    /**
     * @var array
     */
    public $columns = [
        'name' => 'Name',
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
        'name' => 'required',
    ];

}
