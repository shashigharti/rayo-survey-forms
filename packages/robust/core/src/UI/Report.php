<?php
namespace Robust\Core\UI;

use Robust\Core\UI\Core\BaseUI;
use Robust\Core\UI\Traits\CommonTrait;
use Robust\Core\UI\Traits\RouteTrait;

/**
 * Class Report
 * @package Robust\Core\UI
 */
class Report extends BaseUI
{
    use RouteTrait, CommonTrait;

    /**
     * @var string
     */
    public $route_name = 'report-manager';


    /**
     * @var array
     */
    public $columns = [
        'callback' => 'Name',
        'package_name' => 'Package Name',
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => "admin.report-manager.edit",
                'permission' => 'core.report-manager.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => "admin.report-manager.destroy",
                'permission' => 'core.report-manager.delete'
            ]
        ]

    ];

    /**
     * @param $model
     * @return array
     */
    public function getTabs($model)
    {
        return [
            'Report' => ['url' => route("admin.report-manager.edit", [$model->id]), 'permission' => 'core.report-manager.edit']
        ];
    }

    /**
     * @param $params
     * @return string
     */
    public function getName($params){
        return "<a href=" . route('admin.report-manager.reports.show', [$params['id']]) . ">{$params['name']}</a>";
    }


}
