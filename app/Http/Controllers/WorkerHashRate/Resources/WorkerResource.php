<?php

declare(strict_types=1);

namespace App\Http\Controllers\WorkerHashRate\Resources;

use App\Models\Worker;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Worker */
class WorkerResource extends JsonResource
{
//    public function __construct($resource)
//    {
//        parent::__construct($resource);
//    }
//
//    public function toArray($request)
//    {
//        return [
//            'worker_id' => $this->worker_id,
//            'worker_name' => '',
//            'hash_per_min' => '',
//            'hash_per_day: 115 (shares_1h)
//status: “ACTIVE” (status)
//reject_percent: 0.000 (reject_percent)
//unit: T (shares_unit)' => '',
//            'created_at' => $this->created_at,
//
//
//hash_per_day: 115 (shares_1h)
//status: “ACTIVE” (status)
//reject_percent: 0.000 (reject_percent)
//unit: T (shares_unit)
//created_at
//        ];
//    }
}
