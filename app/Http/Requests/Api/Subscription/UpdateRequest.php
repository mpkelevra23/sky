<?php

namespace App\Http\Requests\Api\Subscription;

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
            'user_id' => ['integer', 'exists:users,id'],
            'blog_id' => ['integer', 'exists:blogs,id'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'user_id.integer' => 'The user_id field must be an integer.',
            'user_id.exists' => 'The selected user_id is invalid.',
            'blog_id.integer' => 'The blog_id field must be an integer.',
            'blog_id.exists' => 'The selected blog_id is invalid.',
        ];
    }
}
