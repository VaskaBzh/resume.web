<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WatcherLinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:200|'
                . Rule::unique('watcher_links', 'name')->where('user_id', auth()->user()->id),
            'allowed_routes' => 'required|array|min:1|max:2',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
