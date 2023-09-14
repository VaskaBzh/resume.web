<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinerStat extends Model
{
    use HasFactory;

    public const REWARD_BLOCK = 6.25;

    protected $fillable = [
        'network_hashrate',
        'network_unit',
        'network_difficulty',
        'next_difficulty',
        'change_difficulty',
        'reward_block',
        'price_USD',
        'time_remain',
        'fpps_rate'
    ];
}
