<?php
namespace Robust\Core\Events;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Robust\Admin\Models\User;
use Robust\Core\Helpage\Site;

/**
 * Class UserUpdatedEvent
 * @package Robust\Core\Events
 */
class UserUpdatedEvent extends Mailable
{
    use InteractsWithSockets, SerializesModels;

    public $user;

    /**
     * UserUpdatedEvent constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $this->to($this->user->email);
        return $this->view(Site::templateResolver('core::admin.emails.profile-update'));
    }
}
