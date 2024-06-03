<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * PostResource - это ресурс для постов. Используется для форматирования данных перед отправкой в ответе.
 */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'image' => $this->image,
            'blog_id' => $this->blog_id,
            // Под капотом у нас Carbon объект, поэтому мы можем использовать метод format
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            // Для связей многие ко многим, можно использовать метод pluck, чтобы получить массив значений
            'categories' => $this->categories->pluck('id'),
        ];
    }
}
