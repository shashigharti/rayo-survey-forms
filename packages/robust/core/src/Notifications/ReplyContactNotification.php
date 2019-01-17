<?php
namespace Robust\Core\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Robust\Core\Models\Contact;
use Robust\Core\Helpage\Site;

class ReplyContactNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $contact;

    private $messages;

    public function __construct(Contact $contact, $messages)
    {
        $this->contact = $contact;
        $this->messages = $messages;
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
        $mail_message = (new MailMessage())->subject('Thank You For Contacting Us')
            ->view(Site::templateResolver('core::admin.emails.email-reply'), [
                'messages' => $this->messages,
                'contact' => $this->contact
            ]);
        return $mail_message;
    }


}
