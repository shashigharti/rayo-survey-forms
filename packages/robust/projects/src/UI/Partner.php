<?php
namespace Robust\Projects\UI;

use Robust\Core\UI\Core\BaseUI;
use Robust\Projects\Models\OrganizationType;
use Robust\Projects\Models\Project;

/**
 * Class Partner
 * @package Robust\Projects\UI
 */
class Partner extends BaseUI
{
    /**
     * @var bool
     */
    public $isModal = true;

    /**
     * @var string
     */
    public $route_name = 'projects.partners';

    /**
     * @var array
     */
    public $columns = [
        'name' => 'Organization',

        'organization_type' => 'Organization type',
        'type' => 'Role in the project',
        'contact_person' => 'Contact person',
        'contact_email' => 'Email',
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => 'admin.projects.partners.edit',
                'permission' => 'projects.partners.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => 'admin.projects.partners.destroy',
                'permission' => 'projects.partners.delete'
            ]
        ]
    ];

    /**
     * @var array
     */
    public $left_menu = [
        'add' => ['display_name' => 'Add Partner', 'url' => 'admin.projects.partners.create', 'permission' => 'projects.partners.add']
    ];

    /**
     * @param $model
     * @return array
     */
    public function getTabs($model)
    {
        return [
            'Partner' => ['url' => route("admin.{$this->route_name}.edit", [$model->id]), 'permission' => "projects.partners.manage"]
        ];
    }

    public function getTitle()
    {
        return 'Partner Organizations';
    }

    public function getOrganizationTypes($parent_id)
    {
        $data = OrganizationType::where('project_id', $parent_id)->pluck('name', 'name');
        return $data;
    }
}
