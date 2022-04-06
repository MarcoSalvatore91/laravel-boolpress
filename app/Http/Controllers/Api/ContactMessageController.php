<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Validator;

class ContactMessageController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->all();

        // Validation
        $validator = Validator::make($data, [
            'email' => 'required|email',
            'message' => 'required'
        ], [
            'email.required' => 'La e-mail è obbligatoria',
            'email.email' => 'Indirizzo e-mail non è valido',
            'message.required' => 'Il messaggio è obbligatorio'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $mail = new ContactMessageMail($data);
        Mail::to(env('MAIL_CONTACT_ADDRESS'))->send($mail);

        return response('Mail Sent', 204);
    }
}
