<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachReferralRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => 'string|exists:users,referral_code->code'
        ];
    }

    public function messages()
    {
        return [
            'exists' => 'Не верный код'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
