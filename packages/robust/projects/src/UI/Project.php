<?php
namespace Robust\Projects\UI;

use Robust\Admin\Models\User;
use Robust\Core\UI\Core\BaseUI;

/**
 * Class Project
 * @package Robust\Projects\UI
 */
class Project extends BaseUI
{
    /**
     * @var string
     */
    public $route_name = 'projects';

    /**
     * @var array
     */
    public $columns = [
        'name' => 'Name',
        'Description' => ['callback' => 'Description'],
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => 'admin.projects.edit',
                'permission' => 'projects.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => 'admin.projects.destroy',
                'permission' => 'projects.delete'
            ]
        ]
    ];

    /**
     * @var array
     */
    public $addrules = [
        'name' => 'required',
        'slug' => 'required| unique:projects',
        'type' => 'required',
        'code' => 'required'

    ];

    /**
     * @var array
     */
    public $left_menu = [
        'add' => ['display_name' => 'Add Project', 'url' => 'admin.projects.create', 'permission' => 'projects.add']
    ];

    /**
     * @param $params
     * @return string
     */
    public function getDescription($params)
    {
        return str_limit(strip_tags($params['description']), 40);
    }


    /**
     * @param $model
     * @return array
     */
    public function getTabs($model)
    {
        return [
            'Project' => ['url' => route("admin.projects.edit", [$model->id]), 'permission' => 'projects.manage'],
            'Partners' => ['url' => route("admin.projects.partners.get-project-partners", [$model->id]), 'permission' => 'projects.manage'],
            'Target Groups' => ['url' => route("admin.projects.targets.get-project-targets", [$model->id]), 'permission' => 'projects.manage'],
            'LogFrame' => ['url' => route("admin.projects.log-frame", [$model->id]), 'permission' => 'projects.manage'],
            'Goals' => ['url' => route("admin.projects.goals.get-project-goals", [$model->id]), 'permission' => 'projects.manage'],
            'M&E' => ['url' => route("admin.projects.monitorings.get-project-monitorings", [$model->id]), 'permission' => 'projects.manage'],
            'Permissions' => ['url' => route("admin.projects.permissions.get-project-permissions", [$model->id]), 'permission' => 'projects.manage'],
            'Setting' => ['url' => route("admin.projects.setting.get-project-setting", [$model->id]), 'permission' => 'projects.manage']

        ];
    }

    public function getSelectedUsers($model)
    {
        return $model->users()->get()->pluck('full_name', 'id');
    }

    public function getSelectedUsersId($model)
    {
        return $model->users()->get()->pluck('id');
    }

    public function getUsersForDropdown($model)
    {
        $users = User::all()->except($model->users()->get()->pluck('id')->toArray())->pluck('full_name', 'id');
        return $users;
    }

}
