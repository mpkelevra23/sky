<?php

namespace App\Services;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Collection;

class ProfileService
{
    /**
     * Profile index
     *
     * @param $data
     * @return Collection
     */
    public static function index($data): Collection
    {
        return Profile::filter($data)->get();
    }

    /**
     * Profile store
     *
     * @param array $data
     * @return Profile
     */
    public static function store(array $data): Profile
    {
        return Profile::create($data);
    }

    /**
     * Profile update
     *
     * @param Profile $profile
     * @param array $data
     * @return Profile
     */
    public static function update(Profile $profile, array $data): Profile
    {
        $profile->update($data);
        $profile->save();
        $profile->fresh();

        return $profile;
    }
}
