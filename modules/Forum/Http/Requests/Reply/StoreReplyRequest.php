<?php

namespace Modules\Forum\Http\Requests\Reply;

use App\Exceptions\ThrottleException;
use App\Rules\SpamFree;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Modules\Forum\Domain\Models\Reply;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class
StoreReplyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'body' => ['required', 'string', new SpamFree()],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('create', Reply::class);
    }

//    /**
//     * @return void
//     * @throws ThrottleException
//     */
//    public function failedAuthorization(): void
//    {
//        throw new ThrottleException('you are posting too frequently.', Response::HTTP_FORBIDDEN);
//    }
}
