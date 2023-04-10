<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table = 'incomes';

    protected $guarded = [];

    protected $fillable = [
        'group_id',
        'wallet',
        'amount',
        'payment',
        'percent',
        'diff',
        'unit',
        'hash',
        'status',
        'message',
        'txid',
    ];

    public function sub()
    {
        return $this->belongsTo(Sub::class, 'group_id', 'group_id');
    }
}
