<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',          // <-- adicionando rota api
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Grupos WEB (Inertia/Breeze)
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        // Alias de route middleware 
        $middleware->alias([
            'session.ns' => \App\Http\Middleware\SessionNamespace::class, // <-- novo alias
        ]);

        //  anexar algo aos grupos "api" ou "web", depois de já terem sido definidos:
        // $middleware->appendToGroup('api', \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class);
        // $middleware->appendToGroup('web', \App\Http\Middleware\OutraCoisa::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
