<?php
namespace Robust\Core\UI;

use Robust\Core\UI\Core\BaseUI;


/**
 * Class Block
 * @package Robust\Core\UI
 */
class Block extends BaseUI
{
    /**
     * @var string
     */
    protected $route_name = "theme-block";
    /**
     * @var array
     */
    public $columns = [
        'name' => 'Name',
        'description' => 'Description',
        'options' => [
            'edit' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
                'url' => "admin.theme-block.edit",
                'permission' => 'core.blocks.manage'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => "admin.theme-block.destroy",
                'permission' => 'core.blocks.manage'
            ]
        ]
    ];


    /**
     * @var array
     */
    public $left_menu = [
        'add' => [
            'display_name' => 'Add Blocks',
            'url' => 'admin.theme-block.create',
            'permission' => 'core.blocks.manage'
        ]
    ];


    /**
     * @var array
     */
    public $addrules = [
        'name' => 'required',
        'slug' => 'required| unique:blocks',
        'description' => 'required',
        'column' => 'required',
    ];


    /**
     * @var array
     */
    public $editrules = [];


    /**
     * @param $block
     * @return array
     */
    public function getRoute($block)
    {
        return $block->exists ? ['admin.theme-block.update', $block->id] : ['admin.theme-block.store'];
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return 'Robust\Core\Models\Block';
    }

    /**
     * @param $model
     * @return array
     */
    public function getTabs($model)
    {

        return [
            'Blocks' => ['url' => route('admin.theme-block.edit', [$model->id]), 'permission' => 'core.blocks.manage'],
            'Banners' => [
                'url' => route('admin.block.get-theme-block-banners', [$model->id]),
                'permission' => 'core.blocks.manage'
            ],
            'Pages' => [
                'url' => route('admin.block.get-theme-block-pages', [$model->id]),
                'permission' => 'core.blocks.manage'
            ],

        ];

    }
}
