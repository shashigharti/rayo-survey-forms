<?php
namespace Robust\Reports\UI;

use Robust\Core\UI\Traits\RouteTrait;
/**
 * Class Report
 * @package Robust\Reports\UI
 */
class Report
{
    use RouteTrait;

    /**
     * @var
     */
    private $params;

    /**
     * Form constructor.
     * @param $params
     */
    function __construct($params = null)
    {
        $this->params = $params;
    }

    /**
     * @var array
     */
    public $columns = [
        'title' => 'Title',
        'slug' => 'Slug',
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => 'admin.report-designer.reports.edit',
                'permission' => 'forms.form.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => 'admin.report-designer.reports.destroy',
                'permission' => 'forms.form.delete'
            ]
        ]
    ];

    /**
     * @var array
     */
    public $right_menu = [
        'enable' => ['display_name' => 'Enable', 'url' => '#'],
        'disable' => ['display_name' => 'Disable', 'url' => '#'],
        'Delete' => ['display_name' => 'Delete', 'url' => '#'],
    ];

    /**
     * @var array
     */
    public $left_menu = [
        'add' => ['display_name' => 'Add', 'url' => 'admin.report-designer.reports.create', 'permission' => 'report-designer.report.add']
    ];


    /**
     * @var array
     */
    public $addrules = [
        'title' => 'required',
        'slug' => 'required | unique:reports'
    ];

    /**
     * @var array
     */
    public $editrules = [];

    /**
     * @param $form
     * @return string
     */
    public function getMethod($form)
    {
        return $form->exists ? 'PUT' : 'POST';
    }


    /**
     * @param $form
     * @return array
     */
    public function getRoute($form)
    {
        return $form->exists ? ['admin.report-designer.reports.update', $form->id] : ['admin.report-designer.reports.store'];
    }

    /**
     * @return array
     */
    public function getSubmitText()
    {
        return 'Save';
    }
}
