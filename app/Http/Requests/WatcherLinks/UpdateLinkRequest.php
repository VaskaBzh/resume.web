<?php

declare(strict_types=1);

namespace App\Http\Requests\WatcherLinks;

use App\Rules\WatcherLink\ContainsRouteRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:200',
            'allowed_routes' => ['required', 'array',  new ContainsRouteRule],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
