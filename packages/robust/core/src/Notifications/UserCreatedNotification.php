<?php
namespace Robust\Core\Notifications;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\HtmlString;
use Robust\Core\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class UserCreatedNotification extends Notification
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var User
     */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
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


    public function toMail($notifiable)
    {
       $template = email_template('new-user-registration');
       $config = config('client.email');
       $data = [
           'subject' => isset($template) ? $template->subject :  'Welcome to ' . env('APP_URL'),
           'logo' => '',
           'verification_url' => $this->verificationUrl($notifiable)
       ];
       $from = $config['support'] ?? 'info@robustitconcepts.com';
       $view = isset($template) ? $template->body : view('core::website.auth.email-templates.user-registration')->render();
       $body =  replace_variables($view,$this->user,$data);
       $subject =  replace_variables($data['subject'],$this->user,$data);
       return (new MailMessage)->from($from)->subject($subject)->line(new HtmlString($body));

    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'website.auth.verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            ['id' => $notifiable->token]
        );
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
