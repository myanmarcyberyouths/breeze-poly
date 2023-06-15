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

        if (isset($matches[2]) && !$this->isBase64($matches[2])) {
            $fail('The :attribute must be a valid base64 format');
        }
    }

    public function isBase64($base64): bool
    {
        return base64_encode(base64_decode($base64, true)) === $base64;
    }
}
