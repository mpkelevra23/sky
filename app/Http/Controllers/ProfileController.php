<?php

namespace App\Http\Controllers;

use App\Http\Resources\Profile\ProfileResource;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(): array
    {
        return ProfileResource::collection(Profile::all())->resolve();
    }

    public function show(Profile $profile): array
    {
        return ProfileResource::make($profile)->resolve();
    }

    public function store(): string
    {
        // Создание нового профиля c помощью фабрики
        Profile::factory()->create();
        return 'Profile stored';
    }

    public function update(Profile $profile): string
    {
        $profile->update(
            [
                'first_name' => 'Updated first name',
                'bio' => 'Updated bio',
            ]
        );
        $profile->save();
        return "Profile $profile->id updated";
    }

    public function destroy(Profile $profile): string
    {
        $profile->delete();
        return "Profile $profile->id has been deleted";
    }
}
