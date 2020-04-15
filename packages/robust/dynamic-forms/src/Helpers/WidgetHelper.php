<?php
namespace Robust\DynamicForms\Helpers;

use Carbon\Carbon;
use Robust\DynamicForms\Models\Form;

/**
 * Class WidgetHelper
 * @package Robust\DynamicForms\Helpers
 */
class WidgetHelper
{
    /**
     * @return mixed
     */
    public function getForms(){
        $forms = Form::all();
        return $forms;
    }

    /**
     * @return mixed
     */
    public function getFormsSubmitted(){
        $forms = Form::where('created_at', Carbon::today())->get();
        return $forms->count();
    }
}