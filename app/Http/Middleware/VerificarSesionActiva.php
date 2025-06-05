<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificarSesionActiva
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero.');
        }

        // Verifica si la sesión aún está activa y no expirada
        if (!$request->session()->has('_token')) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Tu sesión ha expirado. Por favor, inicia sesión de nuevo.');
        }

        // Verifica que la navegación venga de dentro del sistema
        $referer = $request->headers->get('referer');
        $host = $request->getSchemeAndHttpHost(); // Ej: http://127.0.0.1:8000

        if (!$referer || strpos($referer, $host) !== 0) {
            return redirect()->route('tareas')->with('error', 'El acceso directo está bloqueado por seguridad.');
        }

        return $next($request);
    }
}
