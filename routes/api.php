<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

// Примеры api-маршрутов для ресурсов
//Route::get('/posts', [PostController::class, 'index']);
//Route::post('/posts', [PostController::class, 'store']);
//Route::get('/posts/{post}', [PostController::class, 'show']);
//Route::patch('/posts/{post}', [PostController::class, 'update']);
//Route::delete('/posts/{post}', [PostController::class, 'destroy']);

// Пример использования метода apiResource
Route::apiResource('posts', PostController::class);
Route::apiResource('profiles', ProfileController::class);
Route::apiResource('blogs', BlogController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('tags', TagController::class);
Route::apiResource('comments', CommentController::class);
Route::apiResource('subscriptions', SubscriptionController::class);
Route::apiResource('notifications', NotificationController::class);
