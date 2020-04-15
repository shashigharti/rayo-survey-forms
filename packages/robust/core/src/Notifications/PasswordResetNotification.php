<?php

namespace Robust\Admin\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;


/**
 * Class PasswordResetNotification
 * @package App\Notifications
 */
class PasswordResetNotification extends Notification
{
    use Queueable;
    /**
     * @var
     */
    protected $token;

    /**
     * CustomResetPasswordNotification constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $link = url( "/password/reset/?token=" . $this->token .'&email='.$notifiable->email);
        $from = settings('email-setting','email') ?? config('rws.client.email.support');
        return ( new MailMessage )
            ->from($from)
            ->subject( 'Reset your password' )
            ->view('admin::website.emails.reset-password',['link'=>$link]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
