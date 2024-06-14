<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EnsureUserHasToken
 * Проверка наличия токена у пользователя
 * @package App\Http\Middleware
 */
class EnsureUserHasToken
{
    /**
     * Handle an incoming request.
     * Обрабатываем входящий запрос и проверяем наличие токена у пользователя.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->bearerToken()) {
            return response()->json(['error' => 'Token not provided'], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
