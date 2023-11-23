<?php

namespace Database\Seeders;

use App\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    public function run(): void
    {
        Wallet::updateOrCreate(['group_id' => 6001912], [
            'name' => 'wallet',
            'minWithdrawal' => 0,
            'wallet' => 'wallet',
            'percent' => 100,
            'wallet_updated_at' => now()->subDays(2),
        ]
        );
    }
}
