<?php

declare(strict_types=1);

namespace App\Actions\Wallet;

use App\Models\Wallet;

class Delete
{
    public static function execute(Wallet $wallet): void
    {
        $wallet->delete();
    }
}
