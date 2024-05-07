<?php

namespace App\Http\Requests\Api\Comment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'post_id' => ['required', 'integer', 'exists:posts,id'],
            'content' => ['required', 'string'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'The user_id field is required.',
            'user_id.integer' => 'The user_id field must be an integer.',
            'user_id.exists' => 'The selected user_id is invalid.',
            'post_id.required' => 'The post_id field is required.',
            'post_id.integer' => 'The post_id field must be an integer.',
            'post_id.exists' => 'The selected post_id is invalid.',
            'content.required' => 'The content field is required.',
            'content.string' => 'The content field must be a string.',
        ];
    }
}
