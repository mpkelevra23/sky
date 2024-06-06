<?php

use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    /**
     * Добавляем посредников для обработки запросов
     */
    ->withMiddleware(function (Middleware $middleware) {
        /**
         * Регистрируем алиасы для посредников
         */
        $middleware->alias([
//            'auth' => \App\Http\Middleware\Authenticate::class,
//            'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
//            'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
//            'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
//            'can' => \Illuminate\Auth\Middleware\Authorize::class,
//            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
//            'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
//            'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
//            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
//            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
            'auth.admin' => IsAdminMiddleware::class,
            'role' => EnsureUserHasRole::class,
        ]);
        /**
         * Регистрируем посредники для обработки всех api-запросов
         */
        $middleware->api(append: [
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
//            isAdminMiddleware::class,
        ]);
        /**
         * Регистрируем посредники для обработки всех web-запросов
         */
        $middleware->web(append: [
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
