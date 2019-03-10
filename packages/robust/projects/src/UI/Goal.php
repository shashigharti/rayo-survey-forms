<?php
namespace Robust\Projects\UI;

use Robust\Core\UI\Core\BaseUI;

/**
 * Class Goal
 * @package Robust\Projects\UI
 */
class Goal extends BaseUI
{
    /**
     * @var string
     */
    public $route_name = 'projects.goals';

    /**
     * @var bool
     */
    public $isModal = true;

    /**
     * @var array
     */
    public $columns = [
        'name' => 'Name',
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => 'admin.projects.goals.edit',
                'permission' => 'projects.goals.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => 'admin.projects.goals.destroy',
                'permission' => 'projects.goals.delete'
            ]
        ]
    ];

    /**
     * @var array
     */
    public $left_menu = [
       // 'add' => ['display_name' => 'Add New Goal', 'url' => 'admin.projects.goals.create', 'permission' => 'projects.goals.add']
    ];

    /**
     * @param $model
     * @return array
     */
    public function getTabs($model)
    {
        return [
            'Goal' => ['url' => route("admin.{$this->route_name}.edit", [$model->id]), 'permission' => "projects.goals.manage"]
        ];
    }
}
