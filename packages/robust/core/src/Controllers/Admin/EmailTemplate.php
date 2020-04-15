<?php

namespace Robust\Core\UI;

use Robust\Core\UI\Core\BaseUI;

/**
 * Class EmailTemplate
 * @package Robust\Core\UI
 */
class EmailTemplate extends BaseUI
{
    /**
     * @var string
     */
    protected $route_name = "email-templates";
    /**
     * @var array
     */
    public $columns = [
        'name' => 'Name',
        'subject' => 'Subject',
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon material-icons">edit</i> ',
                'url' => "admin.email-templates.edit",
                'permission' => 'core.email-templates.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon material-icons">delete</i>',
                'url' => "admin.email-templates.destroy",
                'permission' => 'core.email-templates.delete'
            ]
        ]
    ];
    /**
     * @var array
     */
    public $left_menu = [

    ];

    /**
     * @var array
     */
    public $right_menu = [
        'add' => [
            'display_name' => 'Add', 'url' => 'admin.email-templates.create', 'permission' => 'core.email-templates.add', 'icon' => 'add'
        ]
    ];
    /**
     * @var array
     */
    public $addrules = [
        'name' => 'required',
        'type' => 'required'
    ];
    /**
     * @var array
     */
    public $editrules = [];
    /**
     * @param $category
     * @return array
     */
    public function getRoute($category)
    {
        return $category->exists ? ['admin.email-templates.update', $category->id] : ['admin.email-templates.store'];
    }
    /**
     * @return string
     */
    public function getModel()
    {
        return 'Robust\Core\Models\EmailTemplate';
    }

    /**
     * @param $model
     * @return array
     */
    public function getTabs($model)
    {
        return [
            'Email Template' => ['url' => route('admin.email-templates.edit', [$model->id]), 'permission' => 'core.email-templates.edit'],
            'Preview' => [
                'url' => route('admin.email-templates.preview', [$model->id]),
                'permission' => 'core.email-templates.edit'
            ],
        ];

    }
}
