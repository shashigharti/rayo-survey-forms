<?php
namespace Robust\Core\UI\Core;

use Robust\Core\UI\Traits\CommonTrait;
use Robust\Core\UI\Traits\RouteTrait;

/**
 * Class BaseUI
 * @package Robust\Core\UI\Core
 */
class BaseUI
{
    use RouteTrait, CommonTrait;

    /**
     * @var
     */
    public $params;
    
    /**
     * @var array
     */
    public $addrules = [];
    /**
     * @var array
     */
    public $editrules = [];
    /**
     * @var array
     */
    public $right_menu = [];


    /**
     * @var array
     */
    public $columns = [];

    /**
     * @var bool
     */
    public $isModal = false;

    /**
     * @var string
     */
    public $deleteClass = 'btn btn-info btn-delete btn-xs waves-effect waves-light';

    /**
     * BaseUI constructor.
     * @param null $params
     */
    function __construct($params = null)
    {
        $this->params = $params;
    }


}