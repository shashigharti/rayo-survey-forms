<?php

namespace Robust\Core\Events;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Robust\Core\Helpage\Site;
use Robust\Core\Models\Contact;

/**
 * Class UserCreatedEvent
 * @package Robust\Core\Events
 */
class ContactCreatedEvent extends Mailable
{
    use InteractsWithSockets, SerializesModels;

    public $user;
    public $contact;

    /**
     * UserCreatedEvent constructor.
     */
    public function __construct(Contact $contact, $user = null)
    {
        $this->contact = $contact;
        $this->user = $user;
    }

    public function build()
    {
        $this->to($this->user->email);
        return $this->view(Site::templateResolver('core::admin.emails.contact'));
    }
}
