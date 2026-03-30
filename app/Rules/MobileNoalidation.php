<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MobileNoalidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $valid = true;
        // $valid = false;
        if (mb_strlen($value) == 10) {
            $valid = true;
        }

        if (!$valid) {
            $fail('The :attribute must be a valid Mobile number.');
        }
    }
}
