<?php
namespace Robust\Projects\UI;

use Robust\Core\UI\Core\BaseUI;
use Robust\Core\UI\Traits\RouteTrait;

/**
 * Class Output
 * @package Robust\Projects\UI
 */
class Output extends BaseUI
{
    /**
     * @var string
     */
    public $route_name = 'projects.outputs';

    /**
     * @var bool
     */
    public $isModal = true;

    /**
     * @var array
     */
    public $addrules = [
        'name' => 'required',
        'outcome_id' => 'required'
    ];

    /**
     * @var array
     */
    public $columns = [
        'name' => 'Name',
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => 'admin.projects.outputs.edit',
                'permission' => 'projects.outputs.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => 'admin.projects.outputs.destroy',
                'permission' => 'projects.outputs.delete'
            ]
        ]
    ];

}
