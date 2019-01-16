<?php
namespace Robust\DynamicForms\Helpers;

use Robust\DynamicForms\Models\Data;


/**
 * Class FormDataHelper
 * @package Robust\DynamicForms\Helpers
 */
class FormDataHelper
{

    /**
     * @param $data_id
     * @return bool
     */
    public static function isCompleted($data_id)
    {
        $data = Data::find($data_id);

        return ($data->completed) ? true : false;
    }


    /**
     * @param $user_id
     * @param $form_id
     * @return bool
     */
    public static function getDataByUser($user_id, $form_id)
    {
        $data = Data::where('user_id', $user_id)->where('form_id', $form_id)->get();

        return $data;
    }

}
