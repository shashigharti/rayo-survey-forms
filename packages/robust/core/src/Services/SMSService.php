<?php
namespace Robust\Core\Services;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Mail;

/**
 * Class DataTableService
 * @package Robust\Core\Services
 */
class SMSService
{
    /**
     * @var
     */
    public $from;
    /**
     * @var
     */
    public $token;


    /**
     * MailService constructor.
     */
    public function __construct()
    {
        $this->from = settings('sms-setting', 'from');
        $this->token = settings('sms-setting', 'token');
    }

    /**
     * @param $to
     * @param $text
     */
    public function send($to, $text)
    {
        if ($this->token != "") {

            $args = http_build_query(array(
                'token' => $this->token,
                'from' => $this->from,
                'to' => $to,
                'text' => $text
            ));

            $url = "http://api.sparrowsms.com/v2/sms/";

            # Make the call using API.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // Response
            $response = curl_exec($ch);
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        }
    }
}