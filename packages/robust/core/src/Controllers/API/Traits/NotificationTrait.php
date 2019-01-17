<?php

namespace Robust\Core\Controllers\API\Traits;

use Illuminate\Http\Request;

/**
 * Class CrudTrait
 * @package Robust\Core\Controllers\API\Traits
 */
trait NotificationTrait
{
    public function pushNotification($notifiables, $message)
    {
        $tokens = [];
        foreach ($notifiables as $notifiable) {
            $tokens[] = \PushNotification::Device($notifiable->token);
        }
        $devices = \PushNotification::DeviceCollection($tokens);

        $message = \PushNotification::message($message);
        $collection = \PushNotification::app('RedDoko Buyers')
            ->to($devices)
            ->send($message);
    }
}
