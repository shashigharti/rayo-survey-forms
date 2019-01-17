<?php
namespace Robust\Core\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Robust\Core\Models\Contact;

/**
 * Class UserReplyCreatedEvent
 * @package Robust\Core\Events
 */
class ReplyContactEvent
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var
     */
    public $user;

    /**
     * @var
     */
    public $messages;

    /**
     * ReplyContactEvent constructor.
     * @param Contact $contact
     * @param $messages
     */
    public function __construct(Contact $contact, $messages)
    {
        $this->contact = $contact;
        $this->messages = $messages;
    }
}
