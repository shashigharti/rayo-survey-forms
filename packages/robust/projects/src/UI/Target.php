<?php
namespace Robust\Projects\UI;

use Robust\Core\UI\Core\BaseUI;
use Robust\Projects\Models\BenificiaryType;
use Robust\Projects\Models\IdentificationField;
use Robust\Projects\Models\MicroBenificiary;

/**
 * Class Target
 * @package Robust\Projects\UI
 */
class Target extends BaseUI
{
    /**
     * @var string
     */
    public $route_name = 'projects.targets';

    /**
     * @var bool
     */
    public $isModal = true;

    /**
     * @var array
     */
    public $columns = [
        'name' => 'Target Group',
        'type' => 'Type',
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => 'admin.projects.targets.edit',
                'permission' => 'projects.targets.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => 'admin.projects.targets.destroy',
                'permission' => 'projects.targets.delete'
            ]
        ]
    ];

    /**
     * @var array
     */
    public $left_menu = [
        'add' => ['display_name' => 'Add Group', 'url' => 'admin.projects.targets.create', 'permission' => 'projects.targets.add']
    ];

    /**
     * @param $model
     * @return array
     */
    public function getTabs($model)
    {
        return [
            'Target' => ['url' => route("admin.{$this->route_name}.edit", [$model->id]), 'permission' => "projects.targets.manage"]
        ];
    }

    public function getIdentificationFields($model)
    {
        $array = [
            'Name&&text&&1' => 'Name',
            'Address&&text&&3' => 'Address',
            'Email&&email&&2' => 'Email',
            'Age&&number&&4' => 'Age'
        ];
        if ($model->exists) {
            $fields = IdentificationField::where('target_id', $model->id)->pluck('name');
            foreach ($fields as $field) {
                if (($key = array_search($field, $array)) !== false) {
                    unset($array[$key]);
                }
            }
        }
        return $array;
    }

    public function getSelectedIdentificationFields($model)
    {
        $array = [
            'Name&&text&&1' => 'Name',
            'Address&&text&&3' => 'Address',
            'Email&&email&&2' => 'Email',
            'Age&&number&&4' => 'Age'
        ];
        $new_array = [];
        if ($model->exists) {
            $fields = IdentificationField::where('target_id', $model->id)->pluck('name');
            foreach ($fields as $field) {
                if (($key = array_search($field, $array)) !== false) {
                    $new_array[$key] = $array[$key];
                }
            }
        }

        return $new_array;
    }

    public function getSelectedIdentificationFieldsValue($model)
    {
        $array = [
            'Name&&text&&1' => 'Name',
            'Address&&text&&3' => 'Address',
            'Email&&email&&2' => 'Email',
            'Age&&number&&4' => 'Age'
        ];
        $new_array = [];
        if ($model->exists) {
            $fields = IdentificationField::where('target_id', $model->id)->pluck('name');
            foreach ($fields as $field) {
                if (($key = array_search($field, $array)) !== false) {
                    array_push($new_array, $key);
                }
            }
        }

        return $new_array;
    }

    public function getTypes($parent_id)
    {
        $data = BenificiaryType::where('project_id', $parent_id)->pluck('name', 'name');
        return $data;
    }

    public function getMicroBeneficiaries($parent)
    {
        $data = MicroBenificiary::where('project_id', $parent)->get();
        return $data;
    }
}
