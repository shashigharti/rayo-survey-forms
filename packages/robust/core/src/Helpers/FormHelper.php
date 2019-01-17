<?php
namespace Robust\Core\Helpers;

/**
 * Class FormHelper
 * @package Robust\Core\Helpers
 */
class FormHelper
{
    /**
     * @param $model
     * @return bool
     */
    public function is_edit_mode($model)
    {
        return ($model->exists) ? true : false;
    }

    /**
     * @param $model
     * @return bool
     */
    public function is_add_mode($model)
    {
        return ($model->exists) ? false : true;
    }
}