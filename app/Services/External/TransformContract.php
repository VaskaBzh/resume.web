<?php

declare(strict_types=1);

namespace App\Services\External;

use App\Dto\Sub\TransformSubData;
use App\Models\Sub;
use Illuminate\Support\Collection;

interface TransformContract
{
    public function transformSub(Sub $sub, array $remoteSub): TransformSubData;

    public function transformWorker(array $remoteWorker);

    public function transformCollection(Collection $collection, string $className): Collection;
}
