<?php

declare(strict_types=1);

namespace App\Services\External\BtcCom;

use App\Dto\Sub\SubViewData;
use App\Dto\WorkerData;
use App\Models\Sub;

interface TransformContract
{
    public function transformSub(Sub $sub, array $remoteSub): SubViewData;

    public function transformWorker(array $remoteWorker): WorkerData;
}
