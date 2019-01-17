<?php
namespace Robust\Core\UI;

use Carbon\Carbon;
use Robust\Core\UI\Core\BaseUI;

/**
 * Class Dashboard
 * @package Robust\Core\UI
 */
class Backup extends BaseUI
{
    /**
     * @var array
     */
    public $columns = [
        'name' => 'Name',
        'size' => 'Size',
        'created_at' => ['callback' => 'Date'],
        'options' => [
            'restore' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Restore',
                'url' => "admin.restore.backup",
                'permission' => 'core.backup.manage'
            ],
            'download' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-edit"></i> Download',
                'url' => "admin.backup.download",
                'permission' => 'core.backup.manage'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => "admin.backup.destroy",
                'permission' => 'core.backup.manage'
            ]
        ]

    ];
    /**
     * @var array
     */
    public $left_menu = [
        // 'reset' => ['display_name' => 'Reset', 'url' => 'admin.backup.reset', 'permission' => 'core.backup.manage'],
        'backup' => ['display_name' => 'Back Up', 'url' => 'admin.database.backup', 'permission' => 'core.backup.manage'],


    ];

    /**
     * @param $params
     * @return string
     */
    public function getDate($params)
    {

        $dt = Carbon::parse($params['created_at']);
        return $dt->diffForHumans();
    }


}
