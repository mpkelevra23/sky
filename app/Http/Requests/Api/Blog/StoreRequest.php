<?php

namespace App\Http\Requests\Api\Blog;

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
            'user_id' => ['required', 'integer', 'unique:blogs,user_id', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'url'],
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
            'user_id.unique' => 'The user_id field must be unique.',
            'user_id.exists' => 'The selected user_id is invalid.',
            'title.required' => 'The title field is required.',
            'title.string' => 'The title field must be a string.',
            'title.max' => 'The title field must not exceed 255 characters.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description field must be a string.',
            'image.url' => 'The image field must be a valid URL.',
        ];
    }
}
