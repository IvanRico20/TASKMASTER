<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\VerificarSesionActiva;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // ✅ Registramos alias de middleware para rutas específicas
        $middleware->alias([
            'verificar.sesion' => \App\Http\Middleware\VerificarSesionActiva::class,
        ]);
    })
    

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
