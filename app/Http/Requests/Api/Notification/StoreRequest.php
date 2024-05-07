<?php

namespace App\Http\Requests\Api\Notification;

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
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'status' => ['required', 'string', 'in:unread,read,sent'],
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
            'title.required' => 'The title field is required.',
            'title.string' => 'The title field must be a string.',
            'title.max' => 'The title field must not exceed 255 characters.',
            'content.required' => 'The content field is required.',
            'content.string' => 'The content field must be a string.',
            'status.required' => 'The status field is required.',
            'status.string' => 'The status field must be a string.',
            'status.in' => 'The status field must be one of: unread, read, sent.',
        ];
    }
}
