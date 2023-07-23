<?php

declare(strict_types=1);

namespace App\Actions\Wallet;

use App\Dto\WalletData;
use App\Models\Wallet;

class Upsert
{
    public static function execute(WalletData $walletData): void
    {
        Wallet::updateOrCreate(
            [
                'wallet' => $walletData->walletAddress,
                'group_id' => $walletData->groupId
            ],
            [
                'name' => $walletData->name,
                'group_id' => $walletData->groupId,
                'wallet' => $walletData->walletAddress,
                'minWithdrawal' => $walletData->minWithdrawal,
                'percent' => $walletData->percent,
                'payment' => $walletData->payment,
            ]);
    }
}
