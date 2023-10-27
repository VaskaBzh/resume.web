<?php

declare(strict_types=1);

namespace App\Actions\Wallet;

use App\Models\Wallet;

class ChangeAddress
{
    public static function execute(Wallet $wallet, string $address): bool
    {
        return $wallet->update([
            'wallet' => $address,
            'wallet_updated_at' => now()
        ]);
    }
}
