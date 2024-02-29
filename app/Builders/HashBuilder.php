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

                return $this->getByGroupId($groupId)
                    ->whereDate('created_at', today())
                    ->latest()
                    ->take(96)
                    ->get();

            case 'week':

                DB::statement("SET @row_number := 0");
                $query = "
    SELECT rounded_created_at,
           MIN(hash) AS hash,
           MAX(unit) AS unit,
           MAX(worker_count) AS worker_count
    FROM (
        SELECT *, (@row_number:=@row_number + 1) AS rn
        FROM (
            SELECT MIN(hash) AS hash,
                   DATE_FORMAT(created_at, '%Y-%m-%d %H:00') AS rounded_created_at,
                   unit,
                   worker_count
            FROM hashes
            WHERE created_at >= CURDATE() - INTERVAL 7 DAY
            GROUP BY rounded_created_at, unit, worker_count
        ) AS unique_hashes
        ORDER BY rounded_created_at DESC
    ) AS init
    WHERE HOUR(rounded_created_at) % 2 = 0
    GROUP BY rounded_created_at;
";
                $response = DB::select($query);
                $hashes = Hash::hydrate($response);

                return $hashes;

            case 'month':

//                $records = DB::select(
//                    "SELECT h.*
//    FROM hashes h
//JOIN (
//    SELECT MIN(id) AS min_id
//    FROM (
//        SELECT id,
//            created_at,
//            CASE
//                WHEN HOUR(created_at) < 8 THEN '00:00'
//                WHEN HOUR(created_at) < 18 THEN '08:00'
//                ELSE '16:00'
//            END AS time_slot
//        FROM hashes
//        WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
//        AND created_at < CURDATE()
//    ) AS filtered_hashes
//    GROUP BY DATE(created_at), time_slot
//) AS min_ids ON h.id = min_ids.min_id;"
//                );

                DB::statement("SET @row_number := 0");
                $query = "
    SELECT rounded_created_at,
           MIN(hash) AS hash,
           MAX(unit) AS unit,
           MAX(worker_count) AS worker_count
    FROM (
        SELECT *, (@row_number:=@row_number + 1) AS rn
        FROM (
            SELECT MIN(hash) AS hash,
                   DATE_FORMAT(created_at, '%Y-%m-%d %H:00') AS rounded_created_at,
                   unit,
                   worker_count
            FROM hashes
            WHERE created_at >= CURDATE() - INTERVAL 30 DAY
            GROUP BY rounded_created_at, unit, worker_count
        ) AS unique_hashes
        ORDER BY rounded_created_at DESC
    ) AS init
    WHERE HOUR(rounded_created_at) % 8 = 0
    GROUP BY rounded_created_at;
";
                $response = DB::select($query);

                dd($response);
                $hashes = Hash::hydrate($response);


                return $hashes;
        }
    }
    public function fillHashesToMatrix($hashes, $dateTimeMatrix) {
        return array_reduce($hashes, function ($carry, $item) {
            $carry[$item->rounded_created_at] = $item->hash;
            return $carry;
        }, $dateTimeMatrix);
    }
}
