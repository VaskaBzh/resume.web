<?php

namespace App\Actions\User;

use App\Models\User;

class DeleteConfirmationCode
{
    public static function execute(User $user): void
    {
        $user->confirmation_code = null;
        $user->save();
    }
}
