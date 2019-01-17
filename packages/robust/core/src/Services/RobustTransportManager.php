<?php
namespace Robust\Core\Services;

use Illuminate\Mail\TransportManager;

/**
 * Class RobustTransportManager
 * @package Robust\Core\Services
 */
class RobustTransportManager extends TransportManager
{
    /**
     * RobustTransportManager constructor.
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct($app)
    {
        $this->app = $app;
        $mail = (new \Robust\Core\Helpers\SettingsHelper)->get('email-setting');
        if ($mail) {
            $mail_settings = [
                'driver' => 'smtp',
                'host' => $mail['host'],
                'port' => $mail['port'],
                'from' => ['address' => $mail['email'], 'name' => $mail['name']],
                'username' => $mail['username'],
                'password' => $mail['password'],
                'encryption' => $mail['encryption'],
                'sendmail' => '/usr/sbin/sendmail -bs'
            ];


            $this->app['config']['mail'] = $mail_settings;
        }

    }
}