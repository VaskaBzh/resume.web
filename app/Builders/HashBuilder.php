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
                $records = $this->getByGroupId($groupId)
                    ->latest()
                    ->take(96)
                    ->get();
                $recordCount = count($records);
                if ($recordCount < 96) {
                    $records[$recordCount - 1]->created_at;
                    $fillDate = Carbon::parse($records[$recordCount - 1]->created_at);
                    for ($i = $recordCount; $i < 96; $i++) {
                        $fillDate = $fillDate->subMinutes(15);
                        $hash = new Hash([
                            "hash" => 0,
                            "unit" => "T",
                            "worker_count" => 1,
                        ]);
                        $hash->created_at = $fillDate->format('Y-m-d H:i:s');
                        $records[] = $hash;
                    }
                }
                return $records;

            case 'week':

                DB::statement("SET @row_number := 0");
                $records = DB::select(
                    "SELECT *
                                FROM (
                                    SELECT *, (@row_number:=@row_number + 1) AS rn
                                    FROM (
                                        SELECT MIN(hash) AS hash, DATE_FORMAT(created_at, '%Y-%m-%d %H:%i') AS rounded_created_at
                                        FROM hashes
                                        WHERE created_at >= CURDATE() - INTERVAL 7 DAY
                                        GROUP BY rounded_created_at
                                    ) AS unique_hashes
                                    ORDER BY rounded_created_at DESC
                                ) AS init
                                WHERE rn % 8 = 0;"
                );
                foreach ($records as $record) {
                    $hash = new Hash([
                        'hash' => $record->hash,
                        "unit" => "T",
                        "worker_count" => 1,
                    ]);
                    $hash->created_at = $record->rounded_created_at;
                    $hashes[] = $hash;
                }
//                $recordCount = count($hashes);
//                if ($recordCount < 96) {
//                    $hashes[$recordCount - 1]->rounded_created_at;
//                    $fillDate = Carbon::parse($hashes[$recordCount - 1]->rounded_created_at);
//                    for ($i = $recordCount; $i < 96; $i++) {
//                        $fillDate = $fillDate->subHours(2);
//                        $hash = new Hash([
//                            "hash" => 0,
//                            "unit" => "T",
//                            "worker_count" => 1,
//                        ]);
//                        $hash->created_at = $fillDate->format('Y-m-d H:i:s');
//                        $hashes[] = $hash;
//                    }
//                }

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
                                            ELSE '18:00'
                                        END AS time_slot
                                    FROM hashes
                                    WHERE created_at >= DATE_FORMAT(CURDATE(), '%Y-%m-01')
                                    AND created_at < DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 1 MONTH), '%Y-%m-01')
                                ) AS filtered_hashes
                                GROUP BY DATE(created_at), time_slot
                            ) AS min_ids ON h.id = min_ids.min_id;"
                );

                foreach ($records as $record) {
                    $hash = new Hash([
                        'hash' => $record->hash,
                        "unit" => "T",
                        "worker_count" => 1,
                    ]);
                    $hash->created_at = $record->created_at;
                    $hashes[] = $hash;
                }
//                $recordCount = count($hashes)l;
//                if ($recordCount < 96) {
//                    $hashes[$recordCount - 1]->created_at;
//                    $fillDate = Carbon::parse($hashes[$recordCount - 1]->created_at);
//                    for ($i = $recordCount; $i < 96; $i++) {
//                        $fillDate = $fillDate->subHours(8);
//                        $hash = new Hash([
//                            "hash" => 0,
//                            "unit" => "T",
//                            "worker_count" => 1,
//                        ]);
//                        $hash->created_at = $fillDate->format('Y-m-d H:i:s');
//                        $hashes[] = $hash;
//                    }
//                }
                return $hashes;
        }
    }
}
