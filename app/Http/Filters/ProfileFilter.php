<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProfileFilter extends AbstractFilter
{
    protected array $keys = [
        'first_name',
        'last_name',
        'bio',
        'created_at_from',
        'created_at_to',
        'email',
    ];

    /**
     * @param Builder $query
     * @param string $firstName
     * @return Builder
     */
    public function firstName(Builder $query, string $firstName): Builder
    {
        return $query->where('first_name', 'ilike', "%$firstName%");
    }

    /**
     * @param Builder $query
     * @param string $lastName
     * @return Builder
     */
    public function lastName(Builder $query, string $lastName): Builder
    {
        return $query->where('last_name', 'ilike', "%$lastName%");
    }

    /**
     * @param Builder $query
     * @param string $bio
     * @return Builder
     */
    public function bio(Builder $query, string $bio): Builder
    {
        return $query->where('bio', 'ilike', "%$bio%");
    }

    /**
     * @param Builder $query
     * @param string $createdAtFrom
     * @return Builder
     */
    public function createdAtFrom(Builder $query, string $createdAtFrom): Builder
    {
        return $query->where('created_at', '>=', $createdAtFrom);
    }

    /**
     * @param Builder $query
     * @param string $createdAtTo
     * @return Builder
     */
    public function createdAtTo(Builder $query, string $createdAtTo): Builder
    {
        return $query->where('created_at', '<=', $createdAtTo);
    }

    /**
     * @param Builder $query
     * @param string $email
     * @return Builder
     */
    public function email(Builder $query, string $email): Builder
    {
        return $query->whereHas('user', function ($query) use ($email) {
            $query->where('email', 'ilike', "%$email%");
        });
    }
}
