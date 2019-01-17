<?php
namespace Robust\Core\Services;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Mail;

/**
 * Class DataTableService
 * @package Robust\Core\Services
 */
class MailService
{
    /**
     * @var
     */
    public $from_email;
    /**
     * @var
     */
    public $from_name;
    /**
     * @var
     */
    public $to_email;
    /**
     * @var
     */
    public $subject;
    /**
     * @var
     */
    public $attach;
    /**
     * @var array
     */
    public $data;

    /**
     * @var
     */
    public $view;

    /**
     * MailService constructor.
     */
    public function __construct(Mailer $mailer)
    {
        $this->from_email = "";
        $this->from_name = "";
        $this->to_email = "";
        $this->subject = "";
        $this->data = "";
        $this->view = "";
        $this->mailer = $mailer;

    }

    public function send()
    {
        $this->mailer->send($this->view, $this->data, function ($message) {
            $message->from($this->from_email, $this->from_name);
            $message->to($this->to_email);
            $message->subject($this->subject);

            if ($this->attach = null) {
                $message->attach($this->attach);
            }
        });
    }
}