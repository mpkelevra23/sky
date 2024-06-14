<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Comment\CommentResource;
use Illuminate\Http\Request;

/**
 * PostDetailResource - это ресурс для постов. Используется для форматирования данных перед отправкой в ответе.
 * В данном случае, мы расширяем ресурс PostResource, чтобы добавить к посту комментарии.
 */
class PostDetailResource extends PostResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Мы можем использовать метод toArray родительского класса, чтобы получить все поля поста и с помощью оператора + добавить к ним комментарии через ресурс CommentResource.
        return parent::toArray($request) + [
                'comments' => CommentResource::collection($this->comments)->resolve(),
            ];
    }
}
