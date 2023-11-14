<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\User;
use App\Models\Worker;
use Database\Seeders\RoleAndPermissionsSeeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BaseFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Mining global params
     */
    public MinerStat $stat;

    /**
     * Prepare test db state
     * Create Users, Subs, Workers
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleAndPermissionsSeeder::class);
        $this->stat = MinerStat::factory()->create();
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
                    'status' => 'INACTIVE',
                    'approximate_hash_rate' => 100,
                    'group_id' => 1,
                ],
                [
                    'status' => 'ACTIVE',
                    'approximate_hash_rate' => 100,
                    'group_id' => 1,
                ],
                [
                    'status' => 'INACTIVE',
                    'approximate_hash_rate' => 100,
                    'group_id' => 2,
                ],
                [
                    'status' => 'ACTIVE',
                    'approximate_hash_rate' => 100,
                    'group_id' => 3,
                ],
                [
                    'status' => 'INACTIVE',
                    'approximate_hash_rate' => 100,
                    'group_id' => 3,
                ],
                [
                    'status' => 'ACTIVE',
                    'approximate_hash_rate' => 100,
                    'group_id' => 5,
                ]
            )->create();
    }
}
