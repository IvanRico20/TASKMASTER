<?php

namespace Spatie\Permission\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // Verifica si el usuario tiene el rol requerido
        if (! $request->user()->hasRole($role)) {
            throw UnauthorizedException::forRoles([$role]);
        }

        return $next($request);
    }
}
