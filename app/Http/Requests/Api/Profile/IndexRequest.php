<?php

namespace App\Http\Requests\Api\Profile;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'created_at_from' => ['nullable', 'date_format:Y-m-d'],
            'created_at_to' => ['nullable', 'date_format:Y-m-d'],
            'email' => ['nullable', 'string', 'max:255',],
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
            'bio.string' => 'The bio field must be a string.',
            'created_at_from.date_format' => 'The created_at_from field must be a date in the format Y-m-d.',
            'created_at_to.date_format' => 'The created_at_to field must be a date in the format Y-m-d.',
            'email.string' => 'The email field must be a string.',
        ];
    }
}
