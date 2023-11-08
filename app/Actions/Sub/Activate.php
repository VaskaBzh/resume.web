<?php

declare(strict_types=1);

namespace App\Actions\Sub;

use App\Models\Sub;

class Activate
{
    public static function execute(Sub $sub): void
    {
        $sub->user
            ->subs()
            ->update(['is_active' => false]);

        $sub->update(['is_active' => true]);
    }
}
