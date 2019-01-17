<?php

namespace Robust\Core\UI;

use Robust\Core\UI\Core\BaseUI;

class Redirect extends BaseUI
{
    protected $route_name = "redirects";

    public $columns = [
        'from' => 'From',
        'to' => 'To',
        'hits' => 'Hits',
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => "admin.redirects.edit",
                'permission' => 'core.redirects.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => "admin.redirects.destroy",
                'permission' => 'core.redirects.delete'
            ],
            'enable-disable' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-close-circle"></i> Disable',
                'url' => 'admin.redirects.changestatus',
                'permission' => 'core.redirects.manage'
            ]
        ]
    ];


    /**
     * @var array
     */
    public $left_menu = [
        'add' => ['display_name' => 'Add', 'url' => 'admin.redirects.create', 'permission' => 'core.redirects.add'],
    ];

    /**
     * @var array
     */
    public $addrules = [
        'from' => 'required | unique:redirects',
        'to' => 'required',
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
        return $category->exists ? ['admin.redirects.update', $category->id] : ['admin.redirects.store'];
    }
}
