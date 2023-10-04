<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfirmationCode extends Model
{
    protected $fillable = [
        'user_id',
        'code',
        'model_id',
        'model_type',
        'expires_at'
    ];

    public function model()
    {
        return $this->morphTo;
    }
}
