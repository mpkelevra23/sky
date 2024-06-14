<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Profile\ProfileResource;
use App\Http\Resources\Tag\TagResource;
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
            // Получаем профиль через ресурс ProfileResource
            'profile' => ProfileResource::make($this->profile)->resolve(),
            // Под капотом у нас Carbon объект, поэтому мы можем использовать метод format
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            // Получаем список категорий через ресурс CategoryResource
            'categories' => CategoryResource::collection($this->categories)->resolve(),
            // Получаем список тегов через ресурс TagResource
            'tags' => TagResource::collection($this->tags)->resolve(),

        ];
    }
}
