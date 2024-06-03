<?php

namespace App\Http\Requests\Api\Comment;

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
            'content' => ['nullable', 'string'],
            'post_id' => ['nullable', 'integer', 'exists:posts,id'],
            'profile_id' => ['nullable', 'integer', 'exists:profiles,id'],
            'parent_id' => ['nullable', 'integer', 'exists:comments,id'],
            'created_at_from' => ['nullable', 'date_format:Y-m-d'],
            'created_at_to' => ['nullable', 'date_format:Y-m-d'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     * Сообщения об ошибках валидации
     */
    public function messages(): array
    {
        return [
            'content.string' => 'The content field must be a string.',
            'post_id.integer' => 'The post_id field must be an integer.',
            'post_id.exists' => 'The selected post_id is invalid.',
            'profile_id.integer' => 'The profile_id field must be an integer.',
            'profile_id.exists' => 'The selected profile_id is invalid.',
            'parent_id.integer' => 'The parent_id field must be an integer.',
            'parent_id.exists' => 'The selected parent_id is invalid.',
            'created_at_from.date_format' => 'The created_at_from field must be a date in the format Y-m-d.',
            'created_at_to.date_format' => 'The created_at_to field must be a date in the format Y-m-d.',
        ];
    }
}
