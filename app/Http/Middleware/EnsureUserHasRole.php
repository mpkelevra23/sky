<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EnsureUserHasRole
 * Проверка наличия у пользователя указанной роли
 * @package App\Http\Middleware
 */
class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     * Обрабатываем входящий запрос и проверяем наличие у пользователя указанной роли.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->user()->hasRole($role)) {
            return response()->json(['error' => 'You are not authorized to access this resource'], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
