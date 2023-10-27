<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateConfirmationCode
{
    public static function execute(User $user): string
    {
        $user->update([
            'confirmation_code' => Hash::make($code = $user->generateConfirmationCode())
        ]);

        return $code;
    }
}
