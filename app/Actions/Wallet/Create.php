<?php

namespace App\Actions\Wallet;

use App\Dto\WalletData;
use App\Models\Wallet;

class Create
{
    public static function execute(WalletData $walletData): void
    {
        Wallet::create([
            'name' => $walletData->name,
            'group_id' => $walletData->groupId,
            'wallet' => $walletData->walletAddress,
            'minWithdrawal' => $walletData->minWithdrawal,
            'percent' => 100,
        ]);
    }
}
