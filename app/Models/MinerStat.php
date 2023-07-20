<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MiningStat extends Model
{
    protected $fillable = [
        'network_hashrate',
        'network_unit',
        'network_difficulty',
        'next_difficulty',
        'change_difficulty',
        'reward_block',
        'price_USD',
        'time_remain',
    ];
}
