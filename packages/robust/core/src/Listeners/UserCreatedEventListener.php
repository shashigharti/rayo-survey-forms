<?php


namespace Robust\Core\Listeners;


use Robust\Core\Events\UserCreatedEvent;
use Robust\Core\Notifications\UserCreatedNotification;

/**
 * Class UserCreatedEventListener
 * @package Robust\Core\Listeners
 */
class UserCreatedEventListener
{
    /**
     * @param UserCreatedEvent $event
     */
    public function handle(UserCreatedEvent $event)
    {
        $event->user->update([
            'memberable_id' => $event->user->id,
            'memberable_type' => 'Robust\Core\Models\User'
        ]);
        try {
            $event->user->notify(new UserCreatedNotification($event->user));
        }
        catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }
}
