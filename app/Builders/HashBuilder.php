<?php

declare(strict_types=1);

namespace App\Builders;

use App\Models\Hash;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class HashBuilder extends BaseBuilder
{
    public function getByOffset(int $groupId, ?int $count = 24): Builder
    {
        return $this->getByGroupId($groupId)
            ->latest()
            ->take($count);
    }

    public function getByType(int $groupId, string $period = 'day')
    {
        switch ($period) {
            case 'day':

                $hashes = $this->getByGroupId($groupId)
                    ->whereDate('created_at', today())
                    ->latest()
                    ->take(96)
                    ->get()
                    ->groupBy(function ($hash) {
                        return $hash->created_at->format('Y-m-d H:i');
                    })
                    ->map(function ($group) {
                        return $group->first();
                    });

                $result = [];
                $currentTime = time();
                $currentMinute = date('i', $currentTime);
                $currentRoundedMinute = floor(
                        $currentMinute / 15
                    ) * 15;
                $currentTime = strtotime(
                    date('Y-m-d H:') . $currentRoundedMinute
                );

                for ($i = 0; $i < 24 * 60 / 15; $i++) {
                    $result[date('Y-m-d H:i', $currentTime)] = new Hash([
                        "hash" => 0,
                        "unit" => "T",
                        "worker_count" => 1,
                    ]);
                    $result[date('Y-m-d H:i', $currentTime)]->created_at = date('Y-m-d H:i', $currentTime);
                    $currentTime -= 15 * 60;
                }

                foreach ($hashes as $hash) {
                    $createdAt = $hash->created_at->format('Y-m-d H:i');
                    if (isset($result[$createdAt])) {
                        $result[$createdAt] = new Hash([
                            "hash" => $hash->hash,
                            "unit" => "T",
                            "worker_count" => $hash->worker_count,
                        ]);
                        $result[$createdAt]->created_at = date('Y-m-d H:i', $currentTime);
                    }
                }


                return $result;

            case 'week':

                DB::statement("SET @row_number := 0");

                $records = DB::select(
                    "
    SELECT *
    FROM (
        SELECT *, (@row_number:=@row_number + 1) AS rn
        FROM (
            SELECT MIN(hash) AS hash, DATE_FORMAT(created_at, '%Y-%m-%d %H:00') AS rounded_created_at
            FROM hashes
            WHERE created_at >= CURDATE() - INTERVAL 7 DAY
            GROUP BY rounded_created_at
        ) AS unique_hashes
        ORDER BY rounded_created_at DESC
    ) AS init
    WHERE HOUR(rounded_created_at) % 2 = 0;
"
                );

                dd($records);

                $hashes = [];
                $recordCount = count($records);
                $fillDate = $recordCount == 0 ? now() : Carbon::parse($records[$recordCount - 1]->rounded_created_at);
                foreach ($records as $record) {
                    $hash = new Hash([
                        "hash" => $record->hash,
                        "unit" => "T",
                        "worker_count" => 1,
                    ]);
                    $hash->created_at = $record->rounded_created_at;
                    $hashes[] = $hash;
                }

                for ($i = 0; $i < 96 - $recordCount; $i++) {
                    $fillDate = $fillDate->subHours(2);
                    $hash = new Hash([
                        "hash" => 0,
                        "unit" => "T",
                        "worker_count" => 1,
                    ]);
                    $hash->created_at = $fillDate->format('Y-m-d H:i:s');
                    $hashes[] = $hash;
                }


                return $hashes;

            case 'month':

                $records = DB::select(
                    "SELECT h.*
    FROM hashes h
JOIN (
    SELECT MIN(id) AS min_id
    FROM (
        SELECT id,
            created_at,
            CASE
                WHEN HOUR(created_at) < 8 THEN '00:00'
                WHEN HOUR(created_at) < 18 THEN '08:00'
                ELSE '16:00'
            END AS time_slot
        FROM hashes
        WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
        AND created_at < CURDATE()
    ) AS filtered_hashes
    GROUP BY DATE(created_at), time_slot
) AS min_ids ON h.id = min_ids.min_id;"
                );

                dd($records);

                $hashes = [];
                $recordCount = count($records);

                foreach ($records as $record) {
                    $hash = new Hash([
                        'hash' => $record->hash,
                        "unit" => "T",
                        "worker_count" => 1,
                    ]);
                    $hash->created_at = $record->created_at;
                    $hashes[] = $hash;
                }

                if ($recordCount > 0 && $recordCount < 96) {
                    $fillDate = Carbon::parse($hashes[$recordCount - 1]->created_at);
                } else {
                    $fillDate = now();
                }

                for ($i = $recordCount; $i < 96; $i++) {
                    $fillDate = $fillDate->subHours(8);
                    $hash = new Hash([
                        "hash" => 0,
                        "unit" => "T",
                        "worker_count" => 1,
                    ]);
                    $hash->created_at = $fillDate->format('Y-m-d H:i:s');
                    $hashes[] = $hash;
                }

                return $hashes;
        }
    }
}
