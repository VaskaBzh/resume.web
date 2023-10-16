<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TwoFactorVerifyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string',
            'secret' => 'required|numeric|digits:6'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
