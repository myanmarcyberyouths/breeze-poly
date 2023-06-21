<?php

namespace App\Http\Requests\V1\Auth;

use App\Rules\Base64ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class
ProfileImageRequest extends FormRequest
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
            'profile_image' => ['required',new Base64ValidationRule()],
        ];
    }
}
