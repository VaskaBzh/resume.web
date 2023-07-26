<?php

declare(strict_types=1);

namespace App\Actions\Hashes;

use Illuminate\Database\Eloquent\Builder;

class DeleteOldHashrates
{
    public static function execute(Builder $query): void
    {
        $query->delete();
    }
}
