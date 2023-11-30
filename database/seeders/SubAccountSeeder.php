<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Sub;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubAccountSeeder extends Seeder
{
    public function run(): void
    {
        Sub::updateOrcreate([
            'group_id' => 6001912,
        ], [
            'user_id' => User::whereEmail('forest@gmail.com')->first()->id,
            'group_id' => 6001912,
            'sub' => 'MainTest',
        ]);

        User::where('name', 'like', '%Referral%')
            ->get()
            ->each(function (User $user) {
                $groupID = (int) implode('', [$user->id, '1111']);

                $user->subs()->updateOrCreate(['group_id' => $groupID],
                    [
                        'group_id' => $groupID,
                        'sub' => $user->name,
                        'pending_amount' => 0,
                        'total_amount' => 0,
                        'allbtc_fee' => config('api.btc.fee'),
                    ]);
            });

    }
}
