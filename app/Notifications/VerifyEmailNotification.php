<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Support\Renderable;
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


    protected function verificationEmailUrl(
        $notifiable,
        int $expiredAt,
    ): string
    {
        return URL::temporarySignedRoute(
            $this->actionRoute,
            Carbon::now()->addMinutes($expiredAt),
            [
                'id' => $notifiable->getKey(),
                'hash' => hash('sha256', $notifiable->getEmailForVerification()),
            ],
        );
    }

    private function buildMail($notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->view('mail.user.email-verify')
            ->greeting(__('notifications.greetings', ['email' => $notifiable->email]));

        return match ($this->actionRoute) {
            'v1.verification.verify' => $this->getEmailVerifyMailMessage($mail, $notifiable)
                ->line(__('notifications.email.expired_at.text', ['value' => config('auth.verification.expire') / 60])),
            'v1.password.reset.verify' => $this->getPasswordChangeMailMessage($mail, $notifiable)
                ->line(__('notifications.email.expired_at.text', ['value' => config('auth.verification.expire') / 60])),
            default => throw new \Exception('Wrong route action ' . $this->actionRoute)
        };
    }

    public function getEmailVerifyMailMessage(Renderable $mail, $notifiable): MailMessage
    {
        return $mail
            ->line(__('notifications.email.verify.context'))
            ->action(
                text: __('notifications.email.verify.action-text'),
                url: $this->verificationEmailUrl(
                    $notifiable,
                    config('auth.verification.expire')
                )
            );
    }

    public function getPasswordChangeMailMessage(Renderable $mail, $notifiable): MailMessage
    {
        return $mail
            ->line(__('notifications.email.password-reset.context'))
            ->action(
                text: __('notifications.email.password-reset.action-text'),
                url: $this->verificationEmailUrl(
                    $notifiable,
                    config('auth.passwords.users.expire')
                )
            );
    }


    public function toArray($notifiable): array
    {
        return [];
    }
}
