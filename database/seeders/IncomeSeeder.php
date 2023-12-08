<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Enums\Income\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('incomes')->insert([
            [
                'group_id' => 6001912,
                'payout_id' => 1,
                'type' => Type::MINING->value,
                'daily_amount' => 0.00400000,
                'status' => Status::COMPLETED->value,
                'message' => Message::COMPLETED->value,
                'hash' => 100,
                'unit' => 'T',
                'diff' => 57321508229258,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'group_id' => 6001912,
                'payout_id' => 1,
                'type' => Type::MINING->value,
                'daily_amount' => 0.00400000,
                'status' => Status::COMPLETED->value,
                'message' => Message::COMPLETED->value,
                'hash' => 100,
                'unit' => 'T',
                'diff' => 57321508229258,
                'created_at' => now()->subDay(),
                'updated_at' => now(),
            ],
            [
                'group_id' => 6001912,
                'payout_id' => 1,
                'type' => Type::MINING->value,
                'daily_amount' => 0.00400000,
                'status' => Status::COMPLETED->value,
                'message' => Message::COMPLETED->value,
                'hash' => 100,
                'unit' => 'T',
                'diff' => 57321508229258,
                'created_at' => now()->subDays(2),
                'updated_at' => now(),
            ],
            [
                'group_id' => 6001912,
                'payout_id' => 2,
                'type' => Type::MINING->value,
                'daily_amount' => 0.00400000,
                'status' => Status::COMPLETED->value,
                'message' => Message::COMPLETED->value,
                'hash' => 100,
                'unit' => 'T',
                'diff' => 57321508229258,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'group_id' => 6001912,
                'payout_id' => 2,
                'type' => Type::MINING->value,
                'daily_amount' => 0.00400000,
                'status' => Status::COMPLETED->value,
                'message' => Message::COMPLETED->value,
                'hash' => 100,
                'unit' => 'T',
                'diff' => 57321508229258,
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(3),
            ],
        ]);
    }
}
