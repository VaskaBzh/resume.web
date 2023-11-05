<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Models\MinerStat;
use App\Models\Sub;
use App\Models\User;
use App\Models\Worker;
use App\Services\Internal\IncomeService;
use App\Exceptions\IncomeCreatingException;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Tests\TestCase;

class IncomeServiceTest extends TestCase
{
    public Sub $subWithHashRate;
    public Sub $subWithoutHashRate;

    protected function setUp(): void
    {
        parent::setUp();

        /* Seed database */

        User::factory()->create();
        $this->subWithHashRate = Sub::factory()->create();
        $this->subWithoutHashRate = Sub::factory()->create();
        MinerStat::factory()->create();
        Worker::factory()
            ->count(2)
            ->state(new Sequence(
                    [
                        'status' => 'ACTIVE',
                        'approximate_hash_rate' => 100,
                        'group_id' => $this->subWithHashRate->group_id
                    ],
                    [
                        'status' => 'INACTIVE',
                        'approximate_hash_rate' => 100,
                        'group_id' => $this->subWithHashRate->group_id
                    ],
                    [
                        'status' => 'INACTIVE',
                        'approximate_hash_rate' => 0,
                        'group_id' => $this->subWithoutHashRate->group_id
                    ]
                )
            )
            ->create();

        /* IncomeService */
        $this->service = resolve(IncomeService::class);
    }

    /**
     * @test
     *
     */
    public function it_failed_if_sub_without_hash_rate()
    {
        $this->service->init($this->subWithoutHashRate);
        $this->expectException(IncomeCreatingException::class);
    }

    /**
     * @test
     */
    public function it_create_income_correctly_without_wallet()
    {

        $this->service->init($this->subWithHashRate);

        $this->artisan('income');
    }
}
