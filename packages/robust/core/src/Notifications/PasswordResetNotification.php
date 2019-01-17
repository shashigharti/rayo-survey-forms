<?php

namespace Robust\Core\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Robust\Admin\Models\User;
use Robust\Core\Events\PasswordResetEvent;

class PasswordResetNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $user;
    private $token;

    public function __construct(User $user, $token = null)
    {
        $this->user = $user;
        $this->token = $token;
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
        return new PasswordResetEvent($this->user, $this->token);
    }

}
