<?php

namespace Robust\Core\Listeners;

use Illuminate\Mail\Mailer;
use Robust\Admin\Helpers\UserHelper;
use Robust\Core\Events\ContactCreatedEvent;
use Robust\Core\Helpage\Site;
use Robust\Core\Notifications\ContactNotification;

/**
 * Class ContactCreatedEventListener
 * @package Robust\Core\Listeners
 */
class ContactCreatedEventListener
{

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param ContactCreatedEvent $event
     */
    public function handle(ContactCreatedEvent $event)
    {
        $contact = $event->contact;
        $recipients = emails('contact');
        if ($recipients) {
            $this->mailer->send(Site::templateResolver('core::admin.emails.contact'), ['contact' => $contact,], function ($message) use ($recipients) {
                $message->to($recipients[0]);
                foreach ($recipients as $key => $recipient) {
                    if ($key > 0) {
                        $message->cc($recipient);
                    }
                }
                $message->subject('Contact Created.');
            });
        } else {
            $users = with(new UserHelper())->getAdminUsers();
            try {
                foreach ($users as $user) {
                    $user->notify(new ContactNotification($contact, $user));
                }
            } catch (Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }
}
