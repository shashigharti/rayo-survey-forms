<?php

namespace Robust\Core\UI;

use Robust\Core\UI\Core\BaseUI;

/**
 * Class Media
 * @package Robust\Core\UI
 */
class Media extends BaseUI
{


    /**
     * @var array
     */
    public $columns = [
        'name' => 'name',
        'slug' => 'slug',
        'description' => 'Description',
        'edit' => [
            'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Edit',
            'url' => "admin.media.edit",
            'permission' => 'core.media.edit'
        ],
        'delete' => [
            'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
            'url' => "admin.media.destroy",
            'permission' => 'core.media.delete'
        ]
    ];


}
