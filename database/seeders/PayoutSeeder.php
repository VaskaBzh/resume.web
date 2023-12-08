<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PayoutSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payouts')->insert([
            [
                'group_id' => 6001912,
                'wallet_id' => 1,
                'payout' => 0.00500000,
                'txid' => Str::random(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_id' => 6001912,
                'wallet_id' => 1,
                'payout' => 0.00500000,
                'txid' => Str::random(),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
        ]);
    }
}
