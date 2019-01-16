<?php

namespace Robust\DynamicForms\Listeners;

use Illuminate\Support\Facades\Request;


/**
 * Class FormSavedEventListener
 * @package Robust\DynamicForms\Listeners
 */
class FormSavedEventListener
{

    /**
     * @param $model
     */
    public function handle($model)
    {
        if ($model->users->count() == 0) {
            $model->users()->sync([\Auth::user()->id]);
        }
    }
}

