<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use App\Models\WorkerHashrate;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class WorkerHashRateTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::with('subs.workers.workerHashrates')->first();
        $this->user->markEmailAsVerified();
        Sanctum::actingAs($this->user);
    }

    /**
     * @test
     *
     * @testdox it show worker hash rate list
     */
    public function list(): void
    {
        $worker = $this->user
            ->subs
            ->first()
            ->workers
            ->first();

        $this->getJson(route('v1.worker_hashrate.list', $worker))
            ->assertOk()
            ->assertExactJson([
                'data' => $worker->workerHashrates->map(static function (WorkerHashrate $workerHashrate) {

                    return [
                        'day_at' => $workerHashrate->created_at->format('d.m.Y'),
                        'hash' => $workerHashrate->hash_per_min,
                        'hour_at' => $workerHashrate->created_at->format('H:m'),
                        'id' => $workerHashrate->id,
                        'unit' => $workerHashrate->unit,
                        'worker_id' => $workerHashrate->worker_id,
                    ];
                }),
            ]);
    }
}