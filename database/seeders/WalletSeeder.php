<?php

namespace Database\Seeders;

use App\Models\Sub;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WalletSeeder extends Seeder
{
    public function run(): void
    {
        Sub::each(function (Sub $sub) {
            $sub->wallets()->updateOrCreate(['group_id' => $sub->group_id], [
                'name' => 'wallet',
                'minWithdrawal' => 0,
                'wallet' => Str::random(),
                'percent' => 100,
                'wallet_updated_at' => now()->subDays(2),
            ]);
        });
    }
}
