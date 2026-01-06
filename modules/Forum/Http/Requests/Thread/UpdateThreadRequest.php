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
            'title' => ['sometimes', 'string', 'max:255', 'required_without_all::channel_id,body'],
            'channel_id' => ['sometimes', 'integer', 'exists:channels,id', 'required_without_all:title,body'],
            'body' => ['sometimes', 'string', 'required_without_all:channel_id,title'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $thread = Thread::query()->whereSlug($this->route('slug'))->firstOrFail();
        return $this->user()->can('update', $thread);
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $thread = Thread::query()->whereSlug($this->route('slug'))->firstOrFail();

            $unChanged = (!$this->filled('title') || $this->title === $thread->title) &&
                (!$this->filled('body') || $this->body === $thread->body) &&
                (!$this->filled('channel_id') || (int)$this->channel_id === (int)$thread->channel_id);

            if ($unChanged) {
                $validator->errors()->add('no_change', 'You must change the title, body or channel to update thread.');
            }
        });

    }
}
