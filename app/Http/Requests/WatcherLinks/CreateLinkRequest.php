<?php

namespace App\Http\Requests\WatcherLinks;

use App\Rules\WatcherLink\ContainsRouteRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateLinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:16|'
                . Rule::unique('watcher_links', 'name')->where('user_id', auth()->user()->id),
            'allowed_routes' => ['required', 'array',  new ContainsRouteRule],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
