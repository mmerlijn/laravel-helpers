<?php

namespace mmerlijn\laravelHelpers\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Agbcode implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Dutch AGB code validation: 8 digits
        if (!(preg_match('/^\d{8}$/', trim($value)) == 1)) {
            $fail($this->message());
        }
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Dit is geen geldig AGBcode';
    }
}
