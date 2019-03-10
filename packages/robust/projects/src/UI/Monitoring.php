<?php
namespace Robust\Projects\UI;

use Robust\Core\UI\Core\BaseUI;
use Robust\Projects\Models\MNEType;
use Robust\Projects\Models\RegistrationType;
use Robust\Projects\Models\Target;

/**
 * Class Monitoring
 * @package Robust\Projects\UI
 */
class Monitoring extends BaseUI
{
    /**
     * @var string
     */
    public $route_name = 'projects.monitorings';

    public $isModal = true;

    /**
     * @var array
     */
    public $columns = [
        'name' => 'Name',
        'type' => 'Type',
        'start_date' => 'Start Date',
        'end_date' => 'End Date',

        'options' => [
            'generate' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-arrow-right"></i> Generate Form',
                'url' => 'admin.projects.monitorings.generate-forms',
                'permission' => 'projects.monitorings.edit'
            ],
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => 'admin.projects.monitorings.edit',
                'permission' => 'projects.monitorings.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => 'admin.projects.monitorings.destroy',
                'permission' => 'projects.monitorings.delete'
            ]
        ]
    ];

    /**
     * @var array
     */
    public $left_menu = [
        'add' => ['display_name' => 'Add Verification', 'url' => 'admin.projects.monitorings.create', 'permission' => 'projects.monitorings.add']
    ];

    /**
     * @param $model
     * @return array
     */
    public function getTabs($model)
    {
        return [
            'M&E' => ['url' => route("admin.{$this->route_name}.edit", [$model->id]), 'permission' => "projects.monitorings.manage"]
        ];
    }

    public function getIndicatorParents()
    {
        return [
            'goals' => 'Goals',
            'outcomes' => 'Outcomes',
            'outputs' => 'Outputs',
            'activities' => 'Activities'
        ];
    }

    public function getTargetGroups()
    {
        return Target::pluck('name', 'id')->toArray();
    }

    public function getSelectedIndicators($model)
    {
        return implode(',', $model->indicators()->pluck('id')->toArray()) . ',';

    }

    public function getTypes($parent_id)
    {
        $data = MNEType::where('project_id', $parent_id)->pluck('name', 'name');
        return $data;
    }

    public function getRegistrationTypes($parent_id)
    {
        $data = RegistrationType::where('project_id', $parent_id)->pluck('name', 'name');
        return $data;
    }
}
