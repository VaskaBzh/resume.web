<?php

namespace Database\Seeders;

use App\Models\Sub;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PayoutSeeder extends Seeder
{
    public function run(): void
    {
        Sub::whereHas('wallets')
            ->each(function (Sub $sub) {
                $sub->payouts()->updateOrCreate(['group_id' => $sub->group_id],
                    [
                        'wallet_id' => $sub->wallets()->first()->id,
                        'payout' => 0.00500000,
                        'txid' => Str::random(),
                    ]
                );
            });
    }
}
