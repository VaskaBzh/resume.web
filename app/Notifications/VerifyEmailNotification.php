<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends VerifyEmail
{
    public function __construct(
        private readonly string $actionRoute,
    )
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return $this->buildMail($notifiable);
    }



    protected function verificationEmailUrl($notifiable, string $redirectTo): string
    {
        return URL::temporarySignedRoute(
            $this->actionRoute,
            Carbon::now()->addMinutes(config('auth.verification.expire')),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
                'redirect_to' => config('app.url') . $redirectTo
            ],
            false
        );
    }

    private function buildMail($notifiable): MailMessage
    {
        return match ($this->actionRoute) {
            'v1.verification.verify' => (new MailMessage)
                ->view('mail.user.email-verify')
                ->greeting(__('notifications.greetings', ['email' => $notifiable->email]))
                ->line(__('notifications.email.verify.context'),)
                ->action(
                    text: __('notifications.email.verify.action-text'),
                    url: config('app.url') . $this->verificationEmailUrl($notifiable, '/profile/statistic')
                )
                ->line(__('notifications.email.expired_at.text', ['value' => config('auth.verification.expire') / 60])),
            'v1.password.reset.verify' => (new MailMessage)
                ->view('mail.user.email-verify')
                ->greeting(__('notifications.greetings', ['email' => $notifiable->email]))
                ->line(__('notifications.email.password-reset.context'),)
                ->action(
                    text: __('notifications.email.password-reset.action-text'),
                    url: config('app.url') . $this->verificationEmailUrl($notifiable, 'profile/settings')
                )
                ->line(__('notifications.email.expired_at.text', ['value' => config('auth.verification.expire') / 60])),
            default => throw new \Exception('Wrong route action ' . $this->actionRoute)
        };
    }


    public function toArray($notifiable): array
    {
        return [];
    }
}
