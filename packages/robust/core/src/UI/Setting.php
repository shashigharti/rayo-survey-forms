<?php
namespace Robust\Core\UI;

use Robust\Core\UI\Traits\RouteTrait;

/**
 * Class Setting
 * @package Robust\Core\UI
 */
class Setting
{
    use RouteTrait;
    /**
     * @return string
     */
    public function  getMethod()
    {
        return 'POST';
    }

    /**
     * @return array
     */
    public function getSubmitText()
    {
        return 'Save';
    }
}
