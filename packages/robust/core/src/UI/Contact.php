<?php

namespace Robust\Core\UI;

use Carbon\Carbon;
use Robust\Core\UI\Traits\RouteTrait;

/**
 * Class Contact
 * @package Robust\Core\UI
 */
class Contact
{
    use RouteTrait;

    /**
     * Contact constructor.
     * @param null $params
     */
    function __construct($params = null)
    {
        $this->params = $params;
    }

    /**
     * @var array
     */
    public $columns = [
        'name' => 'Name',
        'email' => 'Email',
        'subject' => 'Subject',
        'Created Date' => ['callback' => 'Date'],
        'type' => 'Type',
        'options' => [
            'view' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-search"></i> View',
                'url' => [
                    'callback' => 'getViewRoute'
                ],
                'permission' => 'core.contacts.manage'
            ],
            'delete' => [
                'display_name' => '<i aria-hidden="true" class="site-menu-icon md-delete"></i> Delete',
                'url' => "admin.contacts.destroy",
                'permission' => 'core.contacts.manage'
            ]
        ]
    ];

    /**
     * @var array
     */
    public $addrules = [

    ];

    /**
     * @var array
     */
    public $editrules = [];

    /**
     * @param $id
     * @return string
     */
    public function getViewRoute($id)
    {
        return route('admin.contacts.show', $id);
    }

    /**
     * @param $params
     * @return string
     */
    public function getDate($params)
    {

        $dt = Carbon::parse($params['created_at']);
        return $dt->format('d/m/Y');
    }
}
