<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class IsAdminMiddleware
 * Проверка наличия у пользователя прав доступа администратора
 * @package App\Http\Middleware
 */
class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     * Обрабатываем входящий запрос и проверяем права доступа администратора.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->is_admin) {
            return response()->json(['error' => 'You are not an admin'], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
