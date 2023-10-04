<?php

declare(strict_types=1);

namespace App\Actions\Wallet;

use App\Models\Wallet;

class ChangeAddress
{
    public static function execute(Wallet $wallet, string $address)
    {
        $wallet->update(['wallet' => $address]);
    }
}
