<?php

declare(strict_types=1);

namespace App\Rules\User;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\Hash;

final readonly class ConfirmationCodeRule implements InvokableRule
{
    public function __invoke($attribute, $value, $fail)
    {
        $hashedCode = auth()->user()->confirmation_code;

        if (! $hashedCode || ! Hash::check($value, $hashedCode)) {
            $fail(__('auth.failed'));
        }
    }
}
