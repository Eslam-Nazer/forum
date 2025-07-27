<?php

namespace Modules\Forum\Http\Requests\Thread;

use Illuminate\Foundation\Http\FormRequest;

class CreateThreadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'channel_id' => ['required', 'integer', 'exists:channels,id'],
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
