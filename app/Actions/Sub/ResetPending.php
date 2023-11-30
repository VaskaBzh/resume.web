<?php

declare(strict_types=1);

namespace App\Actions\Sub;

use App\Models\Sub;

class ResetPending
{
    public static function execute(Sub $sub): void
    {
        $sub->update(['pending_amount' => 0]);
    }
}
