<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TwoFactorVerifyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'two_fa_secret' => 'required|string|numeric'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
