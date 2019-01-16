<?php

namespace Robust\DynamicForms\Helpers;

use Robust\DynamicForms\Models\FormField;

/**
 * Class FormFieldHelper
 * @package Robust\DynamicForms\Helpers
 */
class FormFieldHelper
{
    /**
     * @param $name
     * @return mixed
     */
    public function getField($name)
    {
        $field = FormField::where('name', $name)->first();
        return $field;
    }
}
