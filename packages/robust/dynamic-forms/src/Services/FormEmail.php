<?php
namespace Robust\DynamicForms\Services;

use Mail;

class FormEmail extends Mail
{
    /**
     * @param $data
     */
    public function sendAlertToAdmin($data, $data_id)
    {
       dd('email sent');
    }

    /**
     * @param $form
     * @param $data
     */
    public function sendAlertToUser($form, $data)
    {
        dd('email sent');
    }

}
