<?php

namespace Database\Seeders;

use App\Models\Sub;
use App\Models\Worker;
use App\Services\External\BtcComService;
use Illuminate\Database\Seeder;

class WorkerSeeder extends Seeder
{
    public function run(BtcComService $btcComService): void
    {
        $workers = $btcComService->getWorkerList(6001912);

        $workers->each(
            static fn(array $worker) => Worker::updateOrCreate(['worker_id' => (int)$worker['worker_id']],
                [
                    'group_id' => (int)$worker['gid'],
                    'worker_id' => (int)$worker['worker_id'],
                    'approximate_hash_rate' => (float)$worker['shares_1d'],
                    'pool_data' => $worker,
                ])
        );
    }
}
