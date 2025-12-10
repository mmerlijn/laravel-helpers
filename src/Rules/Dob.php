<?php

namespace mmerlijn\laravelHelpers\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Dob implements ValidationRule
{
    protected int $maxBeforeYears = 120;
    protected int $minBeforeYears = 0;

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $dob = Carbon::parse($value)->startOfDay();
        } catch (\Exception $e) {
            $fail($e->getMessage());
            return;
        }
        if ($dob->isBefore(now()->subYears($this->maxBeforeYears))) {
            $fail('Ongeldige geboortedatum');
        }
        if ($this->minBeforeYears) {
            if ($dob->isAfter(now()->subYears($this->minBeforeYears))) {
                $fail('Cliënten onder de ' . $this->minBeforeYears . ' jaar kunnen alleen telefonisch een afspraak maken, bel voor een afspraak: ' . config('salt.phone'));
            }
        }
        if ($dob->isAfter(now())) {
            $fail('Datum is in de toekomst');
        }
    }

    public function maxBefore(int $years): ValidationRule
    {
        $this->maxBeforeYears = $years;

        return $this;
    }

    public function minBefore(int $years): ValidationRule
    {
        $this->minBeforeYears = $years;
        return $this;
    }
}