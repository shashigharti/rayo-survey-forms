<?php

namespace Robust\Core\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Core\Repositories\ContactRepository;
use Robust\Core\Services\ContactEmail;


class ContactController extends Controller
{
    public function __construct(ContactRepository $contact, ContactEmail $mail)
    {
        $this->contact = $contact;
        $this->mail = $mail;
    }

    public function postContact(Request $request)
    {
        $data = $request->all();
        $data['type'] = 'Contact';

        $contact = $this->contact->store($data);
        $event = 'Robust\Core\Events\ContactCreatedEvent';
        event(new $event($contact));
        $this->mail->sendAlertToUser($contact);
        return response()->json(['status' => true, 'message' => 'Thank you for contacting us. We will respond you soon.']);
    }
}
