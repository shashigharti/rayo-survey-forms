<?php

namespace Robust\DynamicForms\Listeners;

use Illuminate\Support\Facades\Request;


/**
 * Class FormObserver
 * @package Robust\DynamicForms\Observers
 */
class FormSavingEventListener
{

    /**
     * @param $model
     */
    public function handle($model)
    {
        $model->notify_to_admin = Request::has('notify_to_admin') ? 1 : 0;
        $model->notify_to_user = Request::has('notify_to_user') ? 1 : 0;
        $model->single_submit = Request::has('single_submit') ? 1 : 0;
        $model->make_public = Request::has('make_public') ? 1 : 0;
    }
}

