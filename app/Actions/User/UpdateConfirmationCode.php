<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateConfirmationCode
{
    public static function execute(User $user): string
    {
        $code = $user->confirmationCode();

        $user->update(['confirmation_code' => Hash::make($code)]);

        return $code;
    }
}
