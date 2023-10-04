<?php

declare(strict_types=1);

namespace App\Actions\ConfirmationCode;

use App\Models\ConfirmationCode;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Create
{
    public static function execute(Model $model, User $user): ConfirmationCode
    {
        $generateNumber = function ($length) {
            $min = pow(10, $length - 1);
            $max = pow(10, $length) - 1;
            return mt_rand($min, $max);
        };

        return ConfirmationCode::create([
            'code' => $generateNumber(5),
            'user_id' => $user->id,
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'expires_at' => now()->addMinutes(15)
        ]);
    }
}
