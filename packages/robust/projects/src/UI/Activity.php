<?php
namespace Robust\Projects\UI;

use Robust\Core\UI\Core\BaseUI;


/**
 * Class Activity
 * @package Robust\Projects\UI
 */
class Activity extends BaseUI
{
    /**
     * @var string
     */
    public $route_name = 'projects.activities';

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
                'url' => 'admin.projects.activities.edit',
                'permission' => 'projects.activities.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => 'admin.projects.activities.destroy',
                'permission' => 'projects.activities.delete'
            ]
        ]
    ];

    /**
     * @var array
     */
    public $left_menu = [
        'add' => ['display_name' => 'Add New', 'url' => 'admin.projects.activities.create', 'permission' => 'projects.activities.add']
    ];

    /**
     * @param $model
     * @return array
     */
    public function getTabs($model)
    {
        return [
            'Activity' => ['url' => route("admin.{$this->route_name}.edit", [$model->id]), 'permission' => "projects.activities.manage"]
        ];
    }
}
