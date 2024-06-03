<?php

namespace App\Http\Requests\Api\Post;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Класс валидации для фильтрации постов
 */
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
     * Правила валидации для фильтрации постов
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Для фильтрации надо обязательно указать nullable
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
            // По конвенции laravel, название параметра с датой должно быть в формате *_from и *_to, для понимания, что это диапазон
            'created_at_from' => ['nullable', 'date_format:Y-m-d'],
            'created_at_to' => ['nullable', 'date_format:Y-m-d'],
            // Для фильтрации по категориям, используем массив из-за того, что категорий может быть несколько, так как связь многие ко многим
            'category_ids' => ['nullable', 'array'],
//            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     * Сообщения об ошибках валидации
     */
    public function messages(): array
    {
        return [
            'title.string' => 'The title field must be a string.',
            'title.max' => 'The title field must not exceed 255 characters.',
            'content.string' => 'The content field must be a string.',
            'is_published.boolean' => 'The is_published field must be a boolean.',
            'created_at_from.date_format' => 'The created_at_from field must be a date in the format Y-m-d.',
            'created_at_to.date_format' => 'The created_at_to field must be a date in the format Y-m-d.',
            'category_ids.array' => 'The category_ids field must be an array.',
        ];
    }
}
