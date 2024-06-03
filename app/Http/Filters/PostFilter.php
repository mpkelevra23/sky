<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Класс PostFilter содержит методы для фильтрации постов.
 */
class PostFilter extends AbstractFilter
{
    // Массив ключей, по которым будет происходить фильтрация
    protected array $keys = [
        'title',
        'content',
        'is_published',
        'created_at_from',
        'created_at_to',
        'category_ids',
    ];

//    /**
//     * Применяет фильтры к запросу.
//     * Для повышения абстракции и читаемости кода, метод apply следует вынести в абстрактный класс и унаследовать его в других классах фильтров.
//     *
//     * @param Builder $builder
//     * @param array $data
//     * @return Builder
//     */
//    public function apply(Builder $builder, array $data): Builder
//    {
//        foreach ($this->keys as $key) {
//            if (isset($data[$key]) && method_exists($this, Str::camel($key))) {
//                $builder = $this->{Str::camel($key)}($builder, $data[$key]);
//            }
//        }
//
//        return $builder;
//    }

    /**
     * @param Builder $query
     * @param string $title
     * @return Builder
     */
    protected function title(Builder $query, string $title): Builder
    {
        return $query->where('title', 'ilike', "%$title%");
    }

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
     * @param bool $isPublished
     * @return Builder
     */
    protected function isPublished(Builder $query, bool $isPublished): Builder
    {
        return $query->where('is_published', $isPublished);
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

    /**
     * @param Builder $query
     * @param array $categoryIds
     * @return Builder
     */
    protected function categoryIds(Builder $query, array $categoryIds): Builder
    {
        return $query->whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('categories.id', $categoryIds);
        }, '=', count($categoryIds));
    }
}
