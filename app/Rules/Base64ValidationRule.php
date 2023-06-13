<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Base64ValidationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the value is a valid base64 string
        if (!preg_match('/^data:(image\/(jpeg|jpg|png));base64,/', $value)) {
            $fail('The :attribute must be type of jpeg,jpg and png');
        }

        if (!preg_match('/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).*,(.+)/', $value, $matches)) {
            $fail('The :attribute must be valid base64');
        }

        if (isset($matches[2]) && !base64_decode($matches[2], true)) {
            $fail('The :attribute must be type of base64');
        }
    }
}
