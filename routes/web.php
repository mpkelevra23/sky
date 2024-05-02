<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Post routes
Route::get('/posts/index', [PostController::class, 'index']);
Route::get('/posts/store', [PostController::class, 'store']);
Route::get('/posts/show/{post}', [PostController::class, 'show']);
Route::get('/posts/update/{post}', [PostController::class, 'update']);
Route::get('/posts/destroy/{post}', [PostController::class, 'destroy']);

// Profile routes
Route::get('/profiles/index', [ProfileController::class, 'index']);
Route::get('/profiles/store', [ProfileController::class, 'store']);
Route::get('/profiles/show/{profile}', [ProfileController::class, 'show']);
Route::get('/profiles/update/{profile}', [ProfileController::class, 'update']);
Route::get('/profiles/destroy/{profile}', [ProfileController::class, 'destroy']);

// Blog routes
Route::get('/blogs/index', [BlogController::class, 'index']);
Route::get('/blogs/store', [BlogController::class, 'store']);
Route::get('/blogs/show/{blog}', [BlogController::class, 'show']);
Route::get('/blogs/update/{blog}', [BlogController::class, 'update']);
Route::get('/blogs/destroy/{blog}', [BlogController::class, 'destroy']);

// Notification routes
Route::get('/notifications/index', [NotificationController::class, 'index']);
Route::get('/notifications/store', [NotificationController::class, 'store']);
Route::get('/notifications/show/{notification}', [NotificationController::class, 'show']);
Route::get('/notifications/update/{notification}', [NotificationController::class, 'update']);
Route::get('/notifications/destroy/{notification}', [NotificationController::class, 'destroy']);

// Tag routes
Route::get('/tags/index', [TagController::class, 'index']);
Route::get('/tags/store', [TagController::class, 'store']);
Route::get('/tags/show/{tag}', [TagController::class, 'show']);
Route::get('/tags/update/{tag}', [TagController::class, 'update']);
Route::get('/tags/destroy/{tag}', [TagController::class, 'destroy']);

// Category routes
Route::get('/categories/index', [CategoryController::class, 'index']);
Route::get('/categories/store', [CategoryController::class, 'store']);
Route::get('/categories/show/{category}', [CategoryController::class, 'show']);
Route::get('/categories/update/{category}', [CategoryController::class, 'update']);
Route::get('/categories/destroy/{category}', [CategoryController::class, 'destroy']);

// Comment routes
Route::get('/comments/index', [CommentController::class, 'index']);
Route::get('/comments/store', [CommentController::class, 'store']);
Route::get('/comments/show/{comment}', [CommentController::class, 'show']);
Route::get('/comments/update/{comment}', [CommentController::class, 'update']);
Route::get('/comments/destroy/{comment}', [CommentController::class, 'destroy']);

// Subscription routes
Route::get('/subscriptions/index', [SubscriptionController::class, 'index']);
Route::get('/subscriptions/store', [SubscriptionController::class, 'store']);
Route::get('/subscriptions/show/{subscription}', [SubscriptionController::class, 'show']);
Route::get('/subscriptions/update/{subscription}', [SubscriptionController::class, 'update']);
Route::get('/subscriptions/destroy/{subscription}', [SubscriptionController::class, 'destroy']);
