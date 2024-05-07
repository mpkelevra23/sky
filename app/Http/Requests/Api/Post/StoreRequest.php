<?php

namespace App\Http\Requests\Api\Post;

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
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'url'],
            'blog_id' => ['required', 'integer', 'exists:blogs,id'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title field must be a string.',
            'title.max' => 'The title field must not exceed 255 characters.',
            'content.required' => 'The content field is required.',
            'content.string' => 'The content field must be a string.',
            'image.url' => 'The image field must be a valid URL.',
            'blog_id.required' => 'The blog_id field is required.',
            'blog_id.integer' => 'The blog_id field must be an integer.',
        ];
    }

//    /**
//     * Добавление нового атрибута перед валидацией
//     */
//    protected function prepareForValidation()
//    {
//        $this->merge([
//            'new_attribute' => 'value',
//        ]);
//    }
//
//    /**
//     * Добавление нового атрибута после валидации
//     */
//    protected function passedValidation()
//    {
//        $this->merge([
//            'new_attribute' => 'value',
//        ]);
//    }
}
