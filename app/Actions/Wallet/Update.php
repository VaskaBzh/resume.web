<?php

declare(strict_types=1);

namespace App\Actions\Wallet;

use App\Dto\WalletData;
use App\Models\Wallet;

class Update
{
    public static function execute(WalletData $walletData, Wallet $wallet): void
    {
        $wallet->update([
            'name' => $walletData->name,
            'minWithdrawal' => $walletData->minWithdrawal ?? $wallet->minWithdrawal
        ]);
    }
}
