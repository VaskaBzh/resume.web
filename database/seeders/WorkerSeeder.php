<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Actions\Worker\Update;
use App\Dto\WorkerData;
use App\Models\Sub;
use App\Models\WorkerHashrate;
use App\Services\Api\BtcCom\Client;
use App\Services\Api\BtcCom\TransformContract;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WorkerSeeder extends Seeder
{
    public function run(Client $client, TransformContract $transformer): void
    {
        $remoteWorkers = $client->getWorkerList(6001912);

        $remoteWorkers->map(function (array $remoteWorker) use ($transformer) {
            return $transformer->transformWorker($remoteWorker);
        })->each(static function (WorkerData $workerData) {
            Update::execute($workerData);

            WorkerHashrate::create([
                'worker_id' => $workerData->workerId,
                'hash_per_min' => $workerData->hashPerMin,
                'unit' => $workerData->unitPerMin,
            ]);
        });

        Sub::where('sub', 'like', '%Referral%')
            ->get()
            ->each(function (Sub $sub) {
                $worker = (int) implode('', [$sub->group_id, 000000]);

                $sub->workers()->updateOrCreate(['worker_id' => $worker],
                    [
                        'worker_id' => $worker,
                        'name' => $sub->sub.Str::random(10),
                        'hash_per_day' => 93020000000000,
                        'status' => 'ACTIVE',
                        'unit' => 'T',
                        'pool_data' => ['fake' => true],
                    ]);
            });
    }
}
