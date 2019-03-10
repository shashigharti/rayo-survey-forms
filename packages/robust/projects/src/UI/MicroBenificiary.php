<?php
namespace Robust\Projects\UI;

use Robust\Admin\Models\User;
use Robust\Core\UI\Core\BaseUI;

/**
 * Class Project
 * @package Robust\Projects\UI
 */
class MicroBenificiary extends BaseUI
{
    /**
     * @var array
     */
    public $columns = [
        'name' => 'Name',
        'Description' => ['callback' => 'Description'],
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => ['callback' => 'getEditRoute'],
                'permission' => 'projects.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => 'admin.project.setting.destroy',
                'permission' => 'projects.delete',
                'params' => ['model' => 'Robust\Projects\Models\MicroBenificiary']

            ]
        ]
    ];


    /**
     * @param $params
     * @return string
     */
    public function getDescription($params)
    {
        return str_limit(strip_tags($params['description']), 40);
    }

    public function getEditRoute($id)
    {
        return route('admin.project.setting.edit', [$id, 'type' => 'micro_benificiary']);
    }

    public function getRoute($model)
    {
        return $model->exists ? ["admin.project.setting.update", $model->id] : ["admin.project.setting.store"];
    }

    public function getSubmit($model)
    {
        return $model->exists ? 'Edit' : 'Save';
    }
}
