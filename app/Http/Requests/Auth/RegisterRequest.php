<?php

namespace App\Http\Requests\Auth;

use App\Enums\PronounType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|string|email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
            'date_of_birth' => 'required|date_format:d/m/Y',
            'pronoun' => [
                'required',
                Rule::in([PronounType::He,PronounType::She,PronounType::They])
            ],
        ];
    }
}
