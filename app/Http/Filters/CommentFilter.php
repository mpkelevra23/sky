<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class CommentFilter extends AbstractFilter
{
    protected array $keys = [
        'content',
        'post_id',
        'profile_id',
        'parent_id',
        'created_at_from',
        'created_at_to',
    ];

    /**
     * @param Builder $query
     * @param string $content
     * @return Builder
     */
    protected function content(Builder $query, string $content): Builder
    {
        return $query->where('content', 'ilike', "%$content%");
    }

    /**
     * @param Builder $query
     * @param int $postId
     * @return Builder
     */
    protected function postId(Builder $query, int $postId): Builder
    {
        return $query->where('post_id', $postId);
    }

    /**
     * @param Builder $query
     * @param int $profileId
     * @return Builder
     */
    protected function profileId(Builder $query, int $profileId): Builder
    {
        return $query->where('profile_id', $profileId);
    }

    /**
     * @param Builder $query
     * @param int $parentId
     * @return Builder
     */
    protected function parentId(Builder $query, int $parentId): Builder
    {
        return $query->where('parent_id', $parentId);
    }

    /**
     * @param Builder $query
     * @param string $createdAtFrom
     * @return Builder
     */
    protected function createdAtFrom(Builder $query, string $createdAtFrom): Builder
    {
        return $query->whereDate('created_at', '>=', $createdAtFrom);
    }

    /**
     * @param Builder $query
     * @param string $createdAtTo
     * @return Builder
     */
    protected function createdAtTo(Builder $query, string $createdAtTo): Builder
    {
        return $query->whereDate('created_at', '<=', $createdAtTo);
    }
}
