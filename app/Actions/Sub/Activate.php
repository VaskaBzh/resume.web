<?php

declare(strict_types=1);

namespace App\Actions\Sub;

use App\Models\Sub;

class Activate
{
    public static function execute(Sub $sub): void
    {
        Sub::where('user_id', $sub->user_id)
            ->whereNot('group_id', $sub->group_id)
            ->update(['is_active' => false]);
        $sub->update(['is_active' => true]);
    }
}
