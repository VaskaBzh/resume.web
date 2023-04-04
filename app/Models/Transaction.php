<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Указываем, что таблицей для этой модели является 'withdrawals'
    protected $table = 'transactions';

    // Защищенные поля, которые могут быть массово присвоены
    protected $fillable = [
        'wallet_address',
        'amount',
        'status',
        'date',
        'sub_id',
    ];

    // Определение связи с моделью User
    public function sub()
    {
        return $this->belongsTo(Sub::class);
    }
}
