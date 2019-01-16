<?php

namespace Robust\Core\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Robust\Admin\Helpers\UserHelper;
use Robust\DynamicForms\Notifications\FormSubmittedNotification;

/**
 * Class FormSubmittedEvent
 * @package Robust\Core\Events
 */
class FormSubmittedEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;


    /**
     * @var string
     */
    public $data;


    /**
     * FormSubmittedEvent constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $users = (new UserHelper())->getAdminUsers();

        //Create Notification for all admin users
        try {
            foreach ($users as $user) {
                $user->notify(new FormSubmittedNotification());
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        //Data to broadcast
        $this->data = ['count' => 1];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('form-submitted');
    }
}
