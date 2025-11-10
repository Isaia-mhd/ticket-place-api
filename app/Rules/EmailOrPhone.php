<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailOrPhone implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
   public function passes($attribute, $value)
    {
        // Check if its email
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        // Check if its phone number
        if (preg_match('/^[0-9]{10,15}$/', $value)) {
            return true;
        }

        return false;
    }

    public function message()
    {
        return 'Le champ :attribute doit être un email ou un numéro de téléphone valide.';
    }
}
