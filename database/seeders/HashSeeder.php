<?php

namespace Database\Seeders;

use App\Models\Sub;
use App\Models\Worker;
use Illuminate\Database\Seeder;

class HashSeeder extends Seeder
{
    public function run(): void
    {
        Worker::each(function (Worker $worker) {
            $worker->workerHashrates()->create([
                'hash_per_min' => 93826423892651,
                'unit' => 'T',
            ]);
        });

        Sub::each(function (Sub $sub) {
            $sub->hashes()->create([
                'hash' => 90073338303829,
                'unit' => 'T',
                'worker_count' => $sub->workers()->count(),
            ]);
        });
    }
}
