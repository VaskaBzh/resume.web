<?php

declare(strict_types=1);

namespace App\Actions\Hashes;

use App\Models\Hash;

final class DeleteOld
{
    public static function execute(): void
    {
        Hash::oldestThan(date: now()->subMonths(2))->delete();
    }
}
