<?php

declare(strict_types=1);

namespace App\Actions\Sub;

use App\Models\Sub;

class Activate
{
    public static function execute(Sub $sub): void
    {
        $sub->user()->update(['active_sub' => $sub->group_id]);
    }
}
