<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\Category\CategoryResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(): Response
    {
        $categories = CategoryResource::collection(Category::all())->resolve();
        return Inertia::render('Category/Index', compact('categories'));
    }

    public function show(Category $category): Response
    {
        $category = CategoryResource::make($category)->resolve();
        return Inertia::render('Category/Show', compact('category'));
    }

    public function store(): string
    {
        // Создание новой категории c помощью фабрики
        Category::factory()->create();
        return 'Category stored';
    }

    public function update(Category $category): string
    {
        $category->update(
            [
                'name' => 'Updated name',
                'description' => 'Updated description',
            ]
        );
        $category->save();
        return "Category $category->id updated";
    }

    public function destroy(Category $category): string
    {
        $category->delete();
        return "Category $category->id has been deleted";
    }
}
