<?php

namespace App\Rules;

use App\Models\SaveEvent;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EventSaveDuplicateCheckRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $saveEvent = SaveEvent::where('user_id',auth()->user()->id)->where('event_id',$value)->first();

        if($saveEvent)
        {
            if((int)$value === $saveEvent->event_id && $saveEvent != null)
            {
                $fail('You have already saved this event.');
            }
        }
    }
}
