<?php
namespace Robust\Core\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Robust\Core\Models\User;

/**
 * Class UserCreatedEvent
 * @package Robust\Admin\Events
 */
class PasswordResetEvent
{
    use InteractsWithSockets, SerializesModels;

    public $user;
    public $token;

    /**
     * UserCreatedEvent constructor.
     * @param User $user
     * @param $token
     */
    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }
}
