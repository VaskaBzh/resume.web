<?php

declare(strict_types=1);

namespace App\Actions\Hashes;

use App\Models\Hash;
use Illuminate\Database\Eloquent\Collection;

class BulkDelete
{
    public static function execute(Collection $hashes): void
    {
        $hashes->each(static fn(Hash $hash) => $hash->delete());
    }
}
