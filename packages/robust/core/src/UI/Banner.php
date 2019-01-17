<?php
namespace Robust\Core\UI;

use Robust\Core\UI\Core\BaseUI;


/**
 * Class Banner
 * @package Robust\Core\UI
 */
class Banner extends BaseUI
{
    /**
     * @var array
     */
    public $columns = [
        'name' => 'Banners',

    ];


    /**
     * @return string
     */
    public function getModel()
    {
        return 'Robust\Banners\Models\Banner';
    }


}
