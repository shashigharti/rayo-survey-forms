<?php

namespace Robust\Core\Events;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Robust\Admin\Models\User;
use Robust\Core\Helpage\Site;


/**
 * Class ExceptionEvent
 * @package Robust\Core\Events
 */
class ExceptionEvent extends Mailable
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var
     */
    public $exception;


    /**
     * ExceptionEvent constructor.
     * @param $exception
     */
    public function __construct($exception)
    {
        $this->exception = $exception;
    }


    /**
     * @param User $user
     * @return $this
     */
    public function build(User $user)
    {
        $this->to($user->find(1)->email);
        return $this->view(Site::templateResolver('core::admin.emails.exception'), [
            'exception' => $this->exception
        ]);
    }
}
