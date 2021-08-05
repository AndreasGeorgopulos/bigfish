<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumbersDuplicateRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return collect($value)->pluck('phone_number')->duplicates()->count() ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'There cannot be duplicated phone number.';
    }
}
