<?php

namespace App\Http\Requests\V1;

use App\Rules\Base64ValidationRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable', new Base64ValidationRule()],
            'date' => 'required|date_format:d-m-Y',
            'time' => 'required|date_format:H:i:s',
            'place' => 'required',
            'price' => 'required|numeric',
            'about' => 'required|string',
            'visibility' => 'nullable|in:public,private,unlisted',
        ];
    }
}
