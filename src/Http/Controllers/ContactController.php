<?php

namespace Bitfumes\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use Bitfumes\Contact\Mail\ContactMail;
use Bitfumes\Contact\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact::contact');
    }

    public function send(Request $request)
    {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();

        Mail::to(config('contact.send_email_to'))->send(new ContactMail($request->message,$request->name));
        return redirect(route('contact'));
    }
}
