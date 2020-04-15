<?php
namespace Robust\Core\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Robust\Core\Models\User;

/**
 * Class UserActivityEvent
 * @package Robust\Admin\Events
 */
class UserActivityEvent
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var User
     */
    public $user;
    /**
     * @var
     */
    public $title;
    /**
     * @var null
     */
    public $url;
    /**
     * @var
     */
    public $description;


    /**
     * UserActivityEvent constructor.
     * @param User $user
     * @param $title
     * @param null $url
     * @param null $description
     */
    public function __construct(User $user, $title, $url=null, $description=null)
    {
        $this->user = $user->id;
        $this->title = $title;
        $this->url = $url;
        $this->description = $description;
    }
}
