<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Трейт HasFilter содержит метод scopeFilter, который применяет фильтры к запросу.
 */
trait HasFilter
{
    /**
     * В Laravel методы, которые начинаются с scope, являются глобальными методами запроса, которые можно вызывать командой ClassName::filter($data).
     *
     * @param Builder $builder
     * @param array $data
     * @return Builder
     */
    public function scopeFilter(Builder $builder, array $data): Builder
    {
        $filterClass = 'App\Http\Filters\\' . class_basename($this) . 'Filter';

        if (!class_exists($filterClass)) {
            throw new ModelNotFoundException("Filter class {$filterClass} not found.");
        }

        return (new $filterClass())->apply($builder, $data);
    }
}
