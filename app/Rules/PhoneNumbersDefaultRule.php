<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumbersDefaultRule implements Rule
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
        return collect($value)->where('is_default', true)->count() === 1 ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'There can only be 1 default phone number.';
    }
}
