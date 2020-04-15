<?php

namespace Robust\DynamicForms\Listeners;


/**
 * Class FieldObserver
 * @package Robust\DynamicForms\Observers
 */
class FieldEventListener
{

    /**
     * @param $model
     */
    public function handle($model)
    {
        $model->order = $model::max('order') + 1;
    }

}

