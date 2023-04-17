<?php

namespace App\Http\Controllers\SendMessage;

use App\Http\Controllers\Controller;
use App\Mail\MailMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class SendMessageConroller extends Controller
{
    public function send_message(Request $request)
    {
        $messages = [
            'message.required' => 'Сообщение ввести обязательно',
        ];

        $request->validate([
            'message' => 'required',
        ], $messages);

        if ($request->input("contacts")) {
            Mail::to("support@all-btc.com")->send(new MailMessage($request->input('message'), $request->input('contacts')));
        } else {
            Mail::to("support@all-btc.com")->send(new MailMessage($request->input('message')));
        }
    }
}
