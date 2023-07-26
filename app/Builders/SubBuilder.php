<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class SubBuilder extends BaseBuilder
{
    public function oldestHashesThan(string $date): Builder
    {
        return $this->hashes()->whereDate('created_at', '<=', $date);
    }
}
