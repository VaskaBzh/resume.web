<?php

declare(strict_types=1);

namespace App\Services\External;

use Illuminate\Support\Collection;

interface ClientContract
{
    public function call(
        array $segments,
        string $method = 'get',
        array $params = [],
    ): Collection;
    public function getSub(int $groupId): Collection;
    public function getSubList(): Collection;
    public function createRemoteSub(string $subName): Collection;
    public function getWorkerList(?int $groupId = 0, ?string $workerStatus = 'all'): Collection;
    public function updateRemoteWorker(int $workerId, int $groupId): void;
    public function getFppsRate(): float|int;
}
