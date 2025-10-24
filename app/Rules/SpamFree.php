<?php

namespace App\Rules;

use Closure;
use Exception;
use Illuminate\Contracts\Validation\ValidationRule;
use Modules\Forum\Domain\Services\Spam\Spam;

class SpamFree implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            resolve(Spam::class)->detect($value);
        } catch (Exception $exception) {
            $fail('the ' . $attribute . ' is a spam.');
        }
    }
}
