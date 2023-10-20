<?php

declare(strict_types=1);

namespace App\Services\Internal;

use App\Exceptions\BusinessException;
use App\Mail\User\PasswordChangeConfirmationMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\NewAccessToken;
use Symfony\Component\HttpFoundation\Response;

final readonly class UserService
{
    private function __construct(
        private User $user,
    )
    {
    }

    public static function withUser(User $user): UserService
    {
        return new self(user: $user);
    }

    public function changePassword(array $credentials): void
    {
        if (!Hash::check($credentials['old_password'], $this->user->password)) {
            throw new BusinessException('Wrong credentials', Response::HTTP_FORBIDDEN);
        }

        $this->user->update(['password' => Hash::make($credentials['password'])]);

        Mail::to($this->user->email)
            ->send(new PasswordChangeConfirmationMail);
    }

    public function refreshToken(): NewAccessToken
    {
        $this->deleteTokens();

        return $this
            ->user
            ->createToken($this->user->name,
                ['*'],
                now()->addMinutes(config('sanctum.expiration'))
            );
    }

    public function deleteTokens(): void
    {
        $this->user
            ->tokens()
            ->delete();
    }
}
