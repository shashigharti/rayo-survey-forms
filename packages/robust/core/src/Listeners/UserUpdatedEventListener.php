<?php
namespace Robust\Core\Listeners;

use Robust\Core\Events\UserUpdatedEvent;
use Robust\Core\Notifications\ProfileUpdatedNotification;

class UserUpdatedEventListener
{

    /**
     * Handle the event.
     *
     * @param  UserUpdatedEvent  $event
     * @return void
     */
    public function handle(UserUpdatedEvent $event)
    {
        try {
            $event->user->notify(new ProfileUpdatedNotification($event->user));
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

    }
}
