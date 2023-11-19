<?php

declare(strict_types=1);

namespace App\Services\External;

use Illuminate\Support\Collection;

interface ClientContract
{
    public function call(
        string $path,
        string $method = 'get',
        array $params = [],
    ): Collection;

    public function getSub(int $groupId): Collection;

    public function getSubList(): Collection;

    public function createRemoteSub(string $subName): Collection;

    public function getWorkerList(int $groupId, ?string $workerStatus = 'all'): Collection;

    public function updateRemoteWorkers(Collection $data): void;

    public function getFppsRate(): float|int;
}
