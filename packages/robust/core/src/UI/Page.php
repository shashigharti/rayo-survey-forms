<?php
namespace Robust\Core\UI;

use Robust\Core\UI\Core\BaseUI;

/**
 * Class Page
 * @package Robust\Core\UI
 */
class Page extends BaseUI
{

    /**
     * @var array
     */
    public $columns = [
        'name' => 'Pages',

    ];

    /**
     * @return string
     */
    public function getModel()
    {
        return 'Robust\Pages\Models\Page';
    }


}
