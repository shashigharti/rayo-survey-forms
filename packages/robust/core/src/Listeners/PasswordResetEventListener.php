<?php

namespace Robust\Core\Listeners;

use Robust\Core\Events\PasswordResetEvent;
use Robust\Core\Events\UserUpdatedEvent;
use Robust\Core\Notifications\PasswordResetNotification;

class PasswordResetEventListener
{

    /**
     * Handle the event.
     *
     * @param  UserUpdatedEvent $event
     * @return void
     */
    public function handle(PasswordResetEvent $event)
    {
        try {
            $event->user->notify(new PasswordResetNotification($event->user, $event->token));
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

    }
}
