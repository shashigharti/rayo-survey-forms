<?php
namespace Robust\Core\UI;
use Robust\Core\UI\Traits\CommonTrait;
use Robust\Core\UI\Traits\RouteTrait;
/**
 * Class Widget
 * @package Robust\Core\UI
 */
class Widget
{
    use RouteTrait, CommonTrait;
    /**
     * @var string
     */
    public $route_name = 'dashboards.widgets';
    /**
     * @var array
     */
    public $left_menu = [
        'reset' => ['display_name' => 'Reset Widgets', 'url' => 'admin.dashboards.widgets.create', 'permission' => 'core.widgets.create']
    ];
}