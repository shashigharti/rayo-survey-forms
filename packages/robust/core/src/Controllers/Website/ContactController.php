<?php

namespace Robust\Core\Controllers\Website;

use Illuminate\Http\Request;
use Robust\Core\Helpage\Site;
use Robust\Core\Repositories\ContactRepository;
use Robust\Core\Services\ContactEmail;

/**
 * Class ContactController
 * @package Robust\Core\Controllers\Website
 */
class ContactController extends Controller
{
    /**
     * ContactController constructor.
     * @param ContactRepository $contact
     * @param ContactEmail $mail
     */
    public function __construct(ContactRepository $contact, ContactEmail $mail)
    {
        $this->contact = $contact;
        $this->mail = $mail;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contactus()
    {
        return view(Site::templateResolver('core::website.forms.contactus'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function contact(Request $request)
    {
        $this->validate($request, [
            'g-recaptcha-response' => 'required',
        ]);
        $data = $request->all();
        $data['type'] = 'Contact';

        $contact = $this->contact->store($data);
        $event = 'Robust\Core\Events\ContactCreatedEvent';
        event(new $event($contact));
        $this->mail->sendAlertToUser($contact);
        return redirect()->back()->with('message', 'Thank you for contacting us. We will respond you soon.');
    }
}
