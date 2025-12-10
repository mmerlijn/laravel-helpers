<?php

namespace mmerlijn\laravelHelpers\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Requestnr implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $requestnr = trim($value);
        if (!preg_match('/^((ZD|ZP|CW)\d{8}|(PG)\d{9})$/i', $requestnr)) {
            $fail('Geen geldig aanvraagnummer.');
        }
    }
}
