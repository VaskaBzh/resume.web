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
            match ($sub->sub) {
                'MainTest',
                'Referral.2',
                'Referral.3' => $sub->wallets()->updateOrCreate(['group_id' => $sub->group_id], [
                    'name' => 'wallet',
                    'minWithdrawal' => 0,
                    'wallet' => Str::random(),
                    'percent' => 100,
                    'created_at' => now()->subDays(3),
                    'wallet_updated_at' => now()->subDays(2),
                ]),
                'Referral.4',
                'Referral.5' => $sub->wallets()->updateOrCreate(['group_id' => $sub->group_id], [
                    'name' => 'wallet',
                    'minWithdrawal' => 0,
                    'wallet' => Str::random(),
                    'percent' => 100,
                ]),
                default => $sub,
            };
        });
    }
}
