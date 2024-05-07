<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * Category index
     *
     * @return Collection
     */
    public static function index(): Collection
    {
        return Category::all();
    }

    /**
     * Category store
     *
     * @param array $data
     * @return Category
     */
    public static function store(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * Category update
     *
     * @param Category $category
     * @param array $data
     * @return Category
     */
    public static function update(Category $category, array $data): Category
    {
        $category->update($data);
        $category->save();
        $category->fresh();

        return $category;
    }

}
