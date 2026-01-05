<?php

namespace Modules\Forum\Http\Requests\Thread;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Modules\Forum\Domain\Models\Thread;

class UpdateThreadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'channel_id' => ['sometimes', 'integer', 'exists:channels,id'],
            'body' => ['sometimes', 'string'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $thread = Thread::query()->where('slug', '=', $this->route('slug'))->firstOrFail();
        return $this->user()->can('update', $thread);
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $thread = Thread::query()->where('slug', '=', $this->route('slug'))->firstOrFail();

            if (
                $this->filled('title') && $this->input('title') === $thread->title &&
                $this->filled('channel_id') && $this->input('channel_id') === $thread->channel->id &&
                $this->filled('body') && $this->input('body') === $thread->body
            ) {
                $validator->errors()->add('no_change', 'You must change the title, body or channel to update thread.');
            }
        });

    }
}
