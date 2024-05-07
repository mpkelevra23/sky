<?php

namespace App\Services;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Collection;

class BlogService
{
    /**
     * Blog index
     *
     * @return Collection
     */
    public static function index(): Collection
    {
        return Blog::all();
    }

    /**
     * Blog store
     *
     * @param array $data
     * @return Blog
     */
    public static function store(array $data): Blog
    {
        return Blog::create($data);
    }

    /**
     * Blog update
     *
     * @param Blog $blog
     * @param array $data
     * @return Blog
     */
    public static function update(Blog $blog, array $data): Blog
    {
        $blog->update($data);
        $blog->save();
        $blog->fresh();

        return $blog;
    }

}
