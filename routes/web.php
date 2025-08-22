<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Landing simples (opcional): redireciona para escolha de perfil ou cliente
Route::get('/', fn () => Inertia::render('Welcome', [
    'canLogin' => true,
    'canRegister' => false,
]));

// ============ ADMIN ============
Route::prefix('admin')
    ->as('admin.')
    ->middleware(['session.ns:admin'])
    ->group(function () {
        // Auth (login/logout/forgot/etc) do Breeze, sob /admin/*
        require __DIR__.'/auth.php';

        // Rotas autenticadas do Admin
        Route::middleware(['auth', 'verified'])->group(function () {
            Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->name('dashboard');

            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
    });

// ============ BARBEIRO ============
Route::prefix('barbeiro')
    ->as('barbeiro.')
    ->middleware(['session.ns:barbeiro'])
    ->group(function () {
        require __DIR__.'/auth.php';

        Route::middleware(['auth', 'verified'])->group(function () {
            Route::get('/dashboard', fn () => Inertia::render('Barber/Dashboard'))->name('dashboard');
            // adicione aqui páginas do barbeiro (minha agenda, etc.)
        });
    });

// ============ CLIENTE ============
Route::prefix('cliente')
    ->as('cliente.')
    ->middleware(['session.ns:cliente'])
    ->group(function () {
        require __DIR__.'/auth.php';

        Route::middleware(['auth', 'verified'])->group(function () {
            Route::get('/dashboard', fn () => Inertia::render('Client/Dashboard'))->name('dashboard');
            // adicione aqui páginas do cliente (meus horários, planos, etc.)
        });
    });