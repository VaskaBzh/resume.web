<?php

namespace Database\Seeders;

use App\Enums\Income\Message;
use App\Enums\Income\Status;
use App\Enums\Income\Type;
use App\Models\Sub;
use Illuminate\Database\Seeder;

class IncomeSeeder extends Seeder
{
    public function run(): void
    {
        Sub::each(function (Sub $sub) {
            $sub->incomes()
                ->updateOrCreate(['group_id' => $sub->group_id], [
                    'type' => Type::MINING->value,
                    'daily_amount' => 0.00400000,
                    'status' => Status::PENDING->value,
                    'message' => Message::LESS_MIN_WITHDRAWAL->value,
                    'hash' => 100,
                    'diff' => 57321508229258,
                ]);
        });
    }
}
