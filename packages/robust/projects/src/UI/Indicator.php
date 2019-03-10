<?php
namespace Robust\Projects\UI;

use Robust\Core\UI\Core\BaseUI;
use Robust\Projects\Models\RegistrationType;
use Robust\Projects\Models\Target;

/**
 * Class Indicator
 * @package Robust\Projects\UI
 */
class Indicator extends BaseUI
{
    public $route_name = 'projects.indicators';

    /**
     * @var array
     */
    public $columns = [
        'name' => 'Name',
        'type' => 'Type',
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
        'type' => 'required',

    ];

    public function getRegistrationFields($parent_id)
    {
        $data = RegistrationType::where('project_id', $parent_id)->pluck('name', 'name');
        return $data;
    }

    public function getTargetGroups($parent_id)
    {
        return Target::where('project_id', $parent_id)->get();
    }
}
