<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionNamespace
{
    public function handle(Request $request, Closure $next, string $ns = 'app')
    {
        // Muda dinamicamente o nome do cookie de sessão
        config([
            'session.cookie' => "laravel_session_{$ns}",
            // opcional: restringir o cookie ao caminho do grupo
            // 'session.path' => "/{$ns}",
        ]);

        // Se futuramente quiser guards distintos por namespace, pode mexer aqui:
        // config(['auth.defaults.guard' => $ns]);

        return $next($request);
    }
}