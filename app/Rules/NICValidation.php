<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NICValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $valid = false;
        if (preg_match('/^\d{9}[vVxX]$/', $value)) {
            $valid = true;
        }
        if (preg_match('/^\d{12}$/', $value)) {
            $valid = true;
        }

        if (!$valid) {
            $fail('The :attribute must be a valid NIC number.');
        }
    }

    public function message()
    {
        return 'The :attribute must be a valid NIC number.';
    }
}
