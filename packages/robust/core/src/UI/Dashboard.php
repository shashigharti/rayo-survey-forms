<?php
namespace Robust\Core\UI;

use Robust\Core\UI\Core\BaseUI;


/**
 * Class Dashboard
 * @package Robust\Core\UI
 */
class Dashboard extends BaseUI
{

    /**
     * @var string
     */
    public $route_name = 'dashboards';

    /**
     * @var bool
     */
    public $isModal = false;

    /**
     * @var array
     */
    public $left_menu = [
        'add' => ['display_name' => 'Add New', 'url' => 'admin.dashboards.create', 'permission' => 'core.dashboards.add'],
    ];

    /**
     * @var array
     */
    public $columns = [
        'name' => 'Name',
        'is_default' => 'Default',
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => "admin.dashboards.edit",
                'permission' => 'core.dashboards.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => "admin.dashboards.destroy",
                'permission' => 'core.dashboards.delete'
            ]
        ]
        
    ];


    /**
     * @param $model
     * @return array
     */
    public function getTabs($model)
    {
        return [
            'Dashboard' => ['url' => route("admin.dashboards.edit", [$model->id]), 'permission' => 'core.dashboards.edit']
        ];
    }

}
