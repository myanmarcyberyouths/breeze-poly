<?php

namespace App\Http\Requests\V1;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'image_url' => 'nullable|url',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i:s',
            'place' => 'required',
            'price' => 'required|numeric',
            'about' => 'required|string',
            'visibility' => 'nullable|in:public,private,unlisted',
        ];
    }
}
