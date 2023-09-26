<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends VerifyEmail
{
    public function __construct()
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $url = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->line('Нажмите кнопку "Подвердить почту"  перейдите по ссылке для активации аккаунта')
            ->action('Подвердить почту', config('app.url') . $url)
            ->line('Thank you for using our application!');
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'v1.verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
                'redirect_to' =>  config('app.url') . '/v1/profile/statistic'
            ],
            false
        );
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
