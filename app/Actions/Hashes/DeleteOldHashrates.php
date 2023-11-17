<?php

declare(strict_types=1);

namespace App\Actions\Hashes;

use App\Models\Hash;

class DeleteOldHashrates
{
    public static function execute(int $groupId, string $date): void
    {
        Hash::oldestThan(groupId: $groupId, date: $date)->delete();
    }
}
