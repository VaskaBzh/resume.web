<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends VerifyEmail
{
    private const MAIL_EXPIRATION = 1440; /* m */

    public function __construct(
        private readonly string $actionContext,
        private readonly string $actionRoute,
        private readonly string $actionText,
    )
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
            ->view('mail.user.email-verify')
            ->greeting(__('notifications.greetings', ['email' => $notifiable->email]))
            ->line($this->actionContext)
            ->action($this->actionText, config('app.url') . $url)
            ->line(__('notifications.email.expired_at.text', ['value' => self::MAIL_EXPIRATION / 60]));
    }

    protected function verificationUrl($notifiable): string
    {
        return URL::temporarySignedRoute(
            $this->actionRoute,
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', self::MAIL_EXPIRATION)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
                'redirect_to' =>  config('app.url') . '/profile/statistic'
            ],
            false
        );
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
