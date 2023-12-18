<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Hash\Unit;
use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WatcherLink;
use App\Models\Worker;
use App\Utils\HashRateConverter;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TestingSeeder extends Seeder
{
    public function run(): void
    {
        if (config('app.env') !== 'testing') {
            exit('Not testing environment');
        }

        MinerStat::factory()
            ->create();

        User::factory()
            ->count(3)
            ->sequence(
                [
                    'id' => 1,
                    'name' => 'Referrer',
                    'email' => 'first@gmail.com',
                    'password' => bcrypt('123'),
                    'referral_percent' => 1,
                    'referral_discount' => 0,
                    'active_sub' => 1,
                ],
                [
                    'id' => 2,
                    'name' => 'Referral',
                    'email' => 'second@gmail.com',
                    'password' => bcrypt('123'),
                    'referrer_id' => 1,
                    'referral_percent' => 1,
                    'referral_discount' => 0,
                ],
                [
                    'id' => 3,
                    'name' => 'CommonSub',
                    'email' => 'third@gmail.com',
                    'password' => bcrypt('123'),
                    'referral_percent' => 0,
                    'referral_discount' => 0,
                ]
            )->afterCreating(function ($user) {
                match ($user->name) {
                    'Referrer' => Sub::factory()
                        ->count(2)
                        ->state(new Sequence(
                            [
                                'group_id' => 1,
                                'sub' => $user->name,
                                'allbtc_fee' => 3.5,
                                'pending_amount' => 0,
                                'total_amount' => 0,
                                'user_id' => $user->id,
                            ],
                            [
                                'group_id' => 2,
                                'sub' => 'Referrer2',
                                'allbtc_fee' => 3.5,
                                'pending_amount' => 0,
                                'total_amount' => 0,
                                'user_id' => $user->id,
                            ]
                        ))->create(),
                    'Referral' => Sub::factory()
                        ->count(2)
                        ->state(new Sequence(
                            [
                                'group_id' => 3,
                                'sub' => $user->name,
                                'allbtc_fee' => 3.5,
                                'pending_amount' => 0,
                                'total_amount' => 0,
                                'user_id' => $user->id,
                            ],
                            [
                                'group_id' => 4,
                                'sub' => 'Referral2',
                                'allbtc_fee' => 3.5,
                                'pending_amount' => 0,
                                'total_amount' => 0,
                                'user_id' => $user->id,
                            ],
                        ))->create(),
                    'CommonSub' => Sub::factory()->create(
                        [
                            'group_id' => 5,
                            'sub' => $user->name,
                            'allbtc_fee' => 3.5,
                            'pending_amount' => 0,
                            'total_amount' => 0,
                            'user_id' => $user->id,
                        ]
                    ),
                    default => throw new \Exception('Wrong sub'),
                };
            })
            ->create();

        Worker::factory()
            ->count(6)
            ->sequence(
                [
                    'worker_id' => 1111,
                    'status' => 'INACTIVE',
                    'hash_per_day' => HashRateConverter::toPure(100, Unit::TERA_HASH)->value,
                    'group_id' => 1,
                    'pool_data' => [],
                ],
                [
                    'worker_id' => 11111,
                    'status' => 'ACTIVE',
                    'hash_per_day' => HashRateConverter::toPure(100, Unit::TERA_HASH)->value,
                    'group_id' => 1,
                    'pool_data' => [],
                ],
                [
                    'worker_id' => 2222,
                    'status' => 'INACTIVE',
                    'hash_per_day' => HashRateConverter::toPure(100, Unit::TERA_HASH)->value,
                    'group_id' => 2,
                    'pool_data' => [],
                ],
                [
                    'worker_id' => 3333,
                    'status' => 'ACTIVE',
                    'hash_per_day' => HashRateConverter::toPure(100, Unit::TERA_HASH)->value,
                    'group_id' => 3,
                    'pool_data' => [],
                ],
                [
                    'worker_id' => 333333,
                    'status' => 'INACTIVE',
                    'hash_per_day' => HashRateConverter::toPure(100, Unit::TERA_HASH)->value,
                    'group_id' => 3,
                    'pool_data' => [],
                ],
                [
                    'worker_id' => 4444,
                    'status' => 'ACTIVE',
                    'hash_per_day' => HashRateConverter::toPure(100, Unit::TERA_HASH)->value,
                    'group_id' => 5,
                    'pool_data' => [],
                ]
            )->create();

        Wallet::factory()->create(['group_id' => 3]);

        WatcherLink::create([
            'user_id' => 1,
            'name' => 'Test',
            'group_id' => 1,
            'token' => base64_encode(json_encode([
                'name' => 'Test',
                'group_id' => 1,
            ])),
            'allowed_routes' => [
                'v1.sub.show',
                'v1.statistic.show',
                'v1.worker.show',
                'v1.worker.list',
                'v1.worker_hashrate.list',
                'v1.income.list',
                'v1.payout.list',
                'v1.allowed-routes',
            ],
        ]);

        $this->call(HashSeeder::class);
    }
}
