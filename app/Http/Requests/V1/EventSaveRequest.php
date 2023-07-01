<?php

namespace App\Http\Requests\V1;

use App\Rules\EventSaveDuplicateCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class EventSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'event_id' => ['required','exists:events,id',new EventSaveDuplicateCheckRule()]
        ];
    }
}
