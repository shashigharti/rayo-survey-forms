<?php

namespace Robust\Core\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Robust\Admin\Helpers\UserHelper;
use Robust\DynamicForms\Notifications\FormCreatedNotification;
use Robust\DynamicForms\Models\Form;


/**
 * Class FormCreatedEvent
 * @package Robust\Core\Events
 */
class FormCreatedEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var Form
     */
    public $form;


    /**
     * FormCreatedEvent constructor.
     * @param Form $form
     */
    public function __construct(UserHelper $user_helper, Form $form)
    {
        $this->form = $form;
        $users = $user_helper->getOtherUsers();

        //Create Notification for other users
        try {
            foreach ($users as $user) {
                $user->notify(new FormCreatedNotification());
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
        return new PrivateChannel('form-created');
    }
}
