<?php

namespace App\Http\Resources\Comment;

use App\Http\Resources\Profile\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'content' => $this->content,
            'post_id' => $this->post_id,
            'profile' => ProfileResource::make($this->profile)->resolve(),
            'parent_id' => $this->parent_id,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
