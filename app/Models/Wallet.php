<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    // Указываем, что таблицей для этой модели является 'withdrawals'
    protected $table = 'wallets';

    // Защищенные поля, которые могут быть массово присвоены
    protected $fillable = [
        'group_id',
        'minWithdrawal',
        'wallet',
        'percent',
    ];

    public function sub()
    {
        return $this->belongsTo(Sub::class, 'group_id', 'group_id');
    }
}
