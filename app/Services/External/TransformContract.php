<?php

declare(strict_types=1);

namespace App\Services\External;

use App\Dto\Sub\TransformSubData;
use App\Dto\WorkerData;
use App\Models\Sub;
use Illuminate\Support\Collection;

interface TransformContract
{
    public function transformSub(Sub $sub, array $remoteSub): TransformSubData;

    public static function transformWorker(array $remoteWorker): WorkerData;

    public function transformCollection(Collection $collection, string $itemType): Collection;
}
