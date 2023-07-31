<?php

namespace App\Http\Controllers\SendMessage;

use App\Http\Controllers\Controller;
use App\Mail\MailMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class SendMessageConroller extends Controller
{
    public function __invoke(Request $request)
    {
        if (app()->getLocale() === 'ru') {
            $messages = [
                'message.required' => 'Сообщение ввести обязательно',
            ];
        } else if (app()->getLocale() === 'en') {
            $messages = [
                'message.required' => 'The message is required.',
            ];
        }

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
