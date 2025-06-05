<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvitarAccesoDirecto
{
    public function handle(Request $request, Closure $next)
    {
        // Si el usuario no está autenticado, redirige al login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero.');
        }

        // Si no viene de navegación interna (sin referer), redirige
        if (!$request->headers->has('referer')) {
            return redirect()->route('login')->with('error', 'Acceso directo no permitido.');
        }

        return $next($request);
    }
}
