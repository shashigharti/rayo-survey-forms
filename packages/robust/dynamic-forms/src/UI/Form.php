<?php
namespace Robust\DynamicForms\UI;

use Robust\Core\UI\Core\BaseUI;
use Robust\DynamicForms\Models\Form as Model;
use Robust\Projects\Models\Project;

/**
 * Class Form
 * @package Robust\DynamicForms\UI
 */
class Form extends BaseUI
{
    /**
     * @var string
     */
    public $route_name = 'forms';

    /**
     * @var bool
     */
    public $isModal = false;

    /**
     * @var
     */
    public $params;
    /**
     * @var array
     */
    public $columns = [
        'Title' => ['callback' => 'Title'],
        'slug' => 'Slug',
        'Data Submitted' => ['callback' => 'Data Submitted'],
        'options' => [
            'duplicate' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-plus-circle"></i> Duplicate',
                'url' => 'admin.forms.form.duplicate',
                'permission' => 'forms.form.duplicate'
            ],
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => 'admin.forms.edit',
                'permission' => 'forms.form.edit'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => 'admin.forms.destroy',
                'permission' => 'forms.form.delete'
            ],
            'data' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-brush"></i> Data',
                'url' => [
                    'callback' => 'getDataRoute'
                ],
                'permission' => 'forms.data.edit'
            ],
            'enable-disable' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-close-circle"></i> Disable',
                'url' => 'admin.forms.status',
                'permission' => 'forms.form.edit'
            ],
            'export' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-close-circle"></i> Export',
                'url' => 'admin.forms.data.export',
                'permission' => 'forms.form.edit'
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
        'add' => ['display_name' => 'Add', 'url' => 'admin.forms.create', 'permission' => 'forms.form.add']
    ];


    /**
     * @var array
     */
    public $addrules = [
        'title' => 'required',
        'slug' => 'required | unique:dynform_forms'
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
        return $form->exists ? ['admin.forms.update', $form->id] : ['admin.forms.store'];
    }

    /**
     * @return array
     */
    public function getSubmitText()
    {
        return 'Save';
    }


    /**
     * @param $id
     * @return string
     */
    public function getDesignRoute($id)
    {
        return route('admin.forms.design', [$id]);
    }


    /**
     * @param $id
     * @return string
     */
    public function getViewRoute($id)
    {
        return route('admin.forms.show', [$id]);
    }


    /**
     * @param $id
     * @return string
     */
    public function getDataRoute($id)
    {
        return route('admin.forms.data.index', [$id]);
    }

    /**
     * @param string $row
     * @return string
     */
    public function getTitle($row = "")
    {
        return "<a href='" . route('admin.forms.show', [$row['id']]) . "'>" . $row['title'] . "</a>";

    }

    /**
     * @param $params
     * @return string
     */
    public function getDataSubmitted($params)
    {
        $form = Model::find($params['id']);
        return '<a href="' . route("admin.forms.data.index", [$params['id']]) . '"><span class="badge form-badge">' . $form->datas()->count() . '</span></a> ';
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getEmailFields($params)
    {
        return $params->fields()->where('type', 'email')->pluck('label', 'id');
    }

    /**
     * @return string
     */
    public function getCreateRoute($type = 'add', $params = [])
    {
        if (is_array($this->left_menu['add']['url'])) {
            $callback = $this->left_menu['add']['url']['callback'];
            return $this->$callback($this->params['form']->id);
        }

        return route($this->left_menu['add']['url']);
    }

    /**
     * @return mixed
     */
    public function getProjects()
    {
        $url = route('api.projects.list');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "{$url}"
        ));
        $resp = json_decode(curl_exec($curl));
        curl_close($curl);
        return $resp;
    }



    /**
     * @param $model
     * @return array
     */
    public function getTabs($model)
    {
        return [
            'Info' => ['url' => route("admin.{$this->route_name}.edit", [$model->id]), 'permission' => "forms.form.edit"],
            'Design' => ['url' => route("admin.forms.design", [$model->id]), 'permission' => "forms.form.edit"],
            'Preview' => ['url' => route("admin.forms.preview", [$model->id]), 'permission' => "forms.form.show"],
            'Permission' => ['url' => route("admin.forms.permissions", [$model->id]), 'permission' => "forms.form.edit"]

        ];
    }
}
