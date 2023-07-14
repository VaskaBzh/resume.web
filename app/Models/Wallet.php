<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallets';

    protected $fillable = [
        'group_id',
        'minWithdrawal',
        'wallet',
        'percent',
    ];

    public function sub(): BelongsTo
    {
        return $this->belongsTo(Sub::class, 'group_id', 'group_id');
    }
}
