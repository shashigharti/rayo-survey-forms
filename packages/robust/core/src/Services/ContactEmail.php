<?php

namespace Robust\Core\Services;

use Robust\Core\Helpage\Site;
use Robust\Core\Services\MailService;

class ContactEmail extends MailService
{
    /**
     * @param $data
     */
    public function sendAlertToUser($data)
    {
        $data = $data->toArray();
        $data['content'] = 'Thank you for contacting us. One of our team will respond you soon';
        $this->from_email = settings('email-setting', 'email');
        $this->from_name = settings('email-setting', 'name');
        $this->to_email = $data['email'];
        $this->subject = 'Thank you';
        $this->view = Site::templateResolver('core::website.emails.contact_user');
        $this->data = $data;
        $this->send();
    }
}
