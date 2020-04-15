<?php
namespace Robust\Core\Listeners;

use Illuminate\Support\Facades\Log;
use Robust\Core\Models\User;
use Robust\Core\Events\ExceptionEvent;
use Robust\Core\Notifications\ExceptionNotification;


/**
 * Class ExceptionEventListener
 * @package Robust\Core\Listeners
 */
class ExceptionEventListener
{

    /**
     * @param ExceptionEvent $event
     */
    public function handle(ExceptionEvent $event)
    {
        try {
            User::find(1)->notify(new ExceptionNotification($event->exception));
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
