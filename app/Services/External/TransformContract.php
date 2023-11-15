<?php

declare(strict_types=1);

namespace App\Services\External;

use App\Dto\Sub\TransformSubData;
use App\Models\Sub;
use Illuminate\Support\Collection;

interface TransformContract
{
    public function transformSub(Sub $sub, array $data): TransformSubData;
    public function transformCollection(): Collection;
}
