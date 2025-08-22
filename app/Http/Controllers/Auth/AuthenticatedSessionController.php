<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return inertia('Auth/Login', [
            // opcional: passa o prefixo atual para a view
            'prefix' => request()->segment(1), // admin|barbeiro|cliente|null
        ]);
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();  // Breeze faz a validação de credenciais
        $request->session()->regenerate();

        // Detecta o prefixo da rota atual:
        $prefix = $request->segment(1); // ex.: 'admin', 'barbeiro', 'cliente'

        // Decide o destino por prefixo:
        switch ($prefix) {
            case 'admin':
                $intended = route('admin.dashboard');
                break;
            case 'barbeiro':
                $intended = route('barbeiro.dashboard');
                break;
            case 'cliente':
                $intended = route('cliente.dashboard');
                break;
            default:
                // fallback se alguém acessou /login sem prefixo
                $intended = url('/dashboard');
        }

        return redirect()->intended($intended);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Mantém o prefixo no logout para voltar ao login do mesmo “app”
        $prefix = $request->segment(1);
        $loginRoute = match ($prefix) {
            'admin'    => url('/admin/login'),
            'barbeiro' => url('/barbeiro/login'),
            'cliente'  => url('/cliente/login'),
            default    => url('/login'),
        };

        return redirect($loginRoute);
    }
}