<?php
namespace Robust\Core\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Schema;

/**
 * Class DataTableService
 * @package Robust\Core\Services
 */
class DataTableService
{
    /**
     * @param Collection $model
     * @return array
     */
    public function rows(Collection $model)
    {
        return $model->toArray();
    }

    /**
     * @param $ui
     * @return array
     */
    public function headers($ui)
    {
        $cls = new $ui;
        return $cls->columns;
    }

    /**
     * @param $ui
     * @return array
     */
    public function right_menu($ui)
    {
        $cls = new $ui;
        return isset($cls->right_menu)?$cls->right_menu : null;
    }

    /**
     * @param $ui
     * @return array
     */
    public function left_menu($ui)
    {
        $cls = new $ui;
        return isset($cls->left_menu)?$cls->left_menu : null;
    }


}