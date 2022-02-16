<?php

namespace mmerlijn\laravelHelpers\Rules;

use Illuminate\Contracts\Validation\Rule;

class Requestnr implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $requestnr = trim($value);
        if (preg_match('/^((ZD|ZP|CW){1}\d{8}|(PG){1}\d{9})$/i', $requestnr)) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Aanvraagnummer is niet geldig';
    }
}
