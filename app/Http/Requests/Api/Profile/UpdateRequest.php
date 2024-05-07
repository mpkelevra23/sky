<?php

namespace App\Http\Requests\Api\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
//    public function authorize(): bool
//    {
//        return false;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'avatar' => ['nullable', 'url'],
            'bio' => ['string'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'first_name.string' => 'The first_name field must be a string.',
            'first_name.max' => 'The first_name field must not exceed 255 characters.',
            'last_name.string' => 'The last_name field must be a string.',
            'last_name.max' => 'The last_name field must not exceed 255 characters.',
            'avatar.url' => 'The avatar field must be a valid URL.',
            'bio.string' => 'The bio field must be a string.',
        ];
    }
}
