<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\TagController;
use App\Http\Middleware\IsAdminMiddleware;
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

//Route::post('login', [AuthController::class, 'login']);
//Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
//    Route::post('logout', [AuthController::class, 'logout']);
//    Route::post('refresh', [AuthController::class, 'refresh']);
//    Route::post('me', [AuthController::class, 'me']);
//});


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::get('me', [AuthController::class, 'me'])->middleware('auth:api');
});

// Пример использования метода apiResource
// TODO добавить ресурс User?
Route::apiResource('posts', PostController::class);
Route::apiResource('profiles', ProfileController::class)->middleware('jwt.auth');
Route::apiResource('blogs', BlogController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('tags', TagController::class);
Route::apiResource('comments', CommentController::class);
Route::apiResource('subscriptions', SubscriptionController::class);
Route::apiResource('notifications', NotificationController::class);

// Список комментариев доступен только администратору
//Route::get('comments', [CommentController::class, 'index'])->middleware(['jwt.auth', 'auth.admin']);
//Route::get('comments', [CommentController::class, 'index'])->middleware(['jwt.auth', 'role:admin']);

// Просмотр комментария и списка комментариев доступен всем, а добавление, обновление и удаление только администратору
Route::middleware('jwt.auth')->group(function () {
    Route::get('comments', [CommentController::class, 'index']);
    Route::get('comments/{comment}', [CommentController::class, 'show']);
    Route::post('comments', [CommentController::class, 'store'])->middleware('auth.admin');
    Route::patch('comments/{comment}', [CommentController::class, 'update'])->middleware('auth.admin');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->middleware('auth.admin');
});
