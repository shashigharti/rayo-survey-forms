<?php

namespace Robust\Core\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Robust\Admin\Models\User;
use Robust\Core\Events\ContactCreatedEvent;
use Robust\Core\Models\Contact;

class ContactNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $contact;
    private $user;

    public function __construct(Contact $contact, User $user)
    {
        $this->contact = $contact;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
//        $line = 'Click <a href="' . route('admin.contacts.show', $this->contact['id']) . '"> Here </a> to view more';
//        return (new MailMessage)
//            ->line('A new contact us message.')
//            ->line($line);

        return new ContactCreatedEvent($this->contact, $this->user);
    }

}
