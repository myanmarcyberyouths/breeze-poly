<?php

namespace App\Http\Requests\V1;

use App\Rules\Base64ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
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
            'date' => 'required|date_format:d-m-Y',
            'time' => 'required|date_format:H:i:s',
            'place' => 'required',
            'ticket_price' => 'required|numeric',
            'information' => 'required|string',
            'visibility' => 'nullable|in:public,private,unlisted',
            'is_shareable' => 'nullable|boolean',
            'image' => ['nullable', new Base64ValidationRule],
        ];
    }
}
