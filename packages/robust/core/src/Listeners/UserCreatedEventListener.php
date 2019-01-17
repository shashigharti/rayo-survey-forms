<?php
namespace Robust\Core\Listeners;

use Illuminate\Support\Facades\Config;
use Robust\Admin\Helpers\UserHelper;
use Robust\Core\Models\Dashboard;
use Robust\Core\Notifications\RegistrationNotification;
use Robust\Admin\Models\Role;
use Robust\Core\Events\UserCreatedEvent;

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

        //Add a Dashboard for the user
        Dashboard::create([
            'name' => "{$event->user->first_name} Dashboard",
            'slug' => str_slug("{$event->user->first_name} Dashboard"),
            'description' => 'Main Dashboard',
            'is_default' => true,
            'user_id' => $event->user->id
        ]);

//        $users = $user_helper->getAllAdminUsers();
        try {
//            foreach ($users as $user) {
//                $user->notify(new RegistrationNotification());
//            }
            $event->user->notify(new RegistrationNotification($event->user));

        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

    }
}
