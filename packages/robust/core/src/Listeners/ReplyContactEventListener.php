<?php
namespace Robust\Core\Listeners;

use Robust\Core\Events\ReplyContactEvent;
use Robust\Core\Notifications\ReplyContactNotification;

/**
 * Class ContactCreatedEventListener
 * @package Robust\Core\Listeners
 */
class ReplyContactEventListener
{

    /**
     * @param ReplyContactEvent $event
     */
    public function handle(ReplyContactEvent $event)
    {
        $contact = $event->contact;
        $messages = $event->messages;
        $contact->notify(new ReplyContactNotification($contact,$messages));
    }
}
