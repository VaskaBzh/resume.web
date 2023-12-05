<?php

declare(strict_types=1);

namespace App\Actions\Hashes;

use App\Models\Hash;

class Create
{
    public static function execute(
        int $groupId,
        int $hashRate,
        string $unit,
        int $workerCount,
    ): void {
        Hash::create([
            'group_id' => $groupId,
            'hash' => $hashRate,
            'unit' => $unit,
            'worker_count' => $workerCount,
        ]);
    }
}
