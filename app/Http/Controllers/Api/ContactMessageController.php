<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;

class ContactMessageController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->all();



        $mail = new ContactMessageMail($data);
        Mail::to(env('MAIL_CONTACT_ADDRESS'))->send($mail);

        return response('Mail Sent', 204);
    }
}
