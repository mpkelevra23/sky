<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class TagService
{
    /**
     * Tag index
     *
     * @return Collection
     */
    public static function index(): Collection
    {
        return Tag::all();
    }

    /**
     * Tag store
     *
     * @param array $data
     * @return Tag
     */
    public static function store(array $data): Tag
    {
        return Tag::create($data);
    }

    /**
     * Tag update
     *
     * @param Tag $tag
     * @param array $data
     * @return Tag
     */
    public static function update(Tag $tag, array $data): Tag
    {
        $tag->update($data);
        $tag->save();
        $tag->fresh();

        return $tag;
    }

}
