<?php
namespace Robust\Core\UI;

use Robust\Core\UI\Traits\CommonTrait;
use Robust\Core\UI\Traits\RouteTrait;

/**
 * Class Widget
 * @package Robust\Core\UI
 */
class Widget
{
    use RouteTrait, CommonTrait;

    /**
     * @var string
     */
    public $route_name = 'dashboards.widgets';

    /**
     * @var array
     */
    public $left_menu = [
        //'add' => ['display_name' => '+Add New', 'icon' => 'icon md-edit', 'url' => 'admin.dashboards.widgets.create', 'permission' => 'core.widgets.create']
        'reset' => ['display_name' => 'Reset Widgets', 'url' => 'admin.dashboards.widgets.create', 'permission' => 'core.widgets.create']
    ];

    /**
     * @var array
     */
    public $dashboard_menu = [
        'add' => ['display_name' => 'Widget', 'icon' => 'icon md-edit', 'url' => 'admin.dashboards.widgets.add-dashboard-widget', 'permission' => 'core.widgets.add']
    ];

    /**
     * @var array
     */
    public $columns = [
        'name' => 'Name',
        /*'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => "admin.dashboards.widgets.edit",
                'permission' => 'core.widgets.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => "admin.dashboards.widgets.destroy",
                'permission' => 'core.widgets.delete'
            ]
        ]*/

    ];

    /**
     * @param $model
     * @return array
     */
    public function getTabs($model)
    {
        return [
            'Widget' => ['url' => route("admin.dashboards.widgets.edit", [$model->id]), 'permission' => 'core.dashboards.widgets.edit']
        ];
    }


}
