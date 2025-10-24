<?php

namespace Modules\Forum\Http\Requests\Thread;

use App\Rules\SpamFree;
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
            'title' => ['required', 'string', new SpamFree()],
            'body' => ['required', 'string', new SpamFree()],
        ];
    }

    public function messages(): array
    {
        return [
            'channel_id.required' => 'Channel is required.',
            'channel_id.integer' => 'Channel must a valid channel.',
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
