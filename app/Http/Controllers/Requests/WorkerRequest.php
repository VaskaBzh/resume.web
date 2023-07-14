<?php

declare(strict_types=1);

namespace App\Http\Controllers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'worker_id' => 'required',
            'group_id' => 'required',
        ];
    }
}
