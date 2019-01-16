<?php
namespace Robust\Core\Listeners;

use Robust\Admin\Helpers\UserHelper;
use Robust\Core\Events\FormSubmittedEvent;
use Robust\Core\Notifications\FormSubmittedNotification;

/**
 * Class FormSubmittedEventListener
 * @package Robust\Core\Listeners
 */
class FormSubmittedEventListener
{
    /**
     * @param FormSubmittedEvent $event
     */
    public function handle(UserHelper $user_helper, FormSubmittedEvent $event)
    {
        $users = $user_helper->getAllAdminUsers();

        try {
            foreach ($users as $user) {
                $user->notify(new FormSubmittedNotification());
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

    }
}
