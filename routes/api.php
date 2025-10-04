<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\{
  ServiceController, BarberController, CustomerController, PlanController, BusinessClosureController
};
use App\Http\Controllers\Admin\SubscriptionController;

use App\Http\Controllers\Op\{
  AppointmentController, QueueController, SaleController
};

use App\Http\Controllers\PushController;
use App\Http\Controllers\ReportController;


/**
 * =========================
 * PÚBLICO (Cliente - sem login)
 * =========================
 * Para o funil de agendamento: cliente escolhe barbeiro → serviço → horário.
 * Esses endpoints não expõem dados sensíveis, apenas listagens filtradas.
 */
Route::prefix('public')->group(function () {
    // Listar barbeiros ativos
    Route::get('/barbers', [BarberController::class, 'index']); // Se quiser, crie um método indexPublic filtrando campos

    // Listar serviços ativos (opcional: por barbeiro)
    Route::get('/services', [ServiceController::class, 'index']); // idem: pode criar um indexPublic

    // Disponibilidades (precisa implementar no AppointmentController ou um AvailabilityController)
    Route::get('/availability', [AppointmentController::class, 'availability']); 
    // esperado: ?barber_id=1&date=2025-10-07 → retorna slots livres do dia
});


/**
 * =========================
 * 🔐 PROTEGIDO COM SANCTUM
 * =========================
 * SPA com Sanctum (Breeze/Inertia). Aqui entram admin, barbeiro e (futuramente) cliente autenticado.
 */
Route::middleware('auth:sanctum')->group(function () {

  // PWA / Push
  Route::post  ('/push/subscribe',   [PushController::class, 'subscribe']);
  Route::delete('/push/unsubscribe', [PushController::class, 'unsubscribe']);

  /**
   * ========== ADMIN ==========
   * Se você usa Spatie, aplique 'role:admin'.
   * Caso contrário, crie um middleware 'is_admin' e aplique aqui.
   */
  Route::middleware(['role:admin'])->group(function () {
      // CRUDs de gestão
      Route::apiResource('services', ServiceController::class);
      Route::apiResource('barbers',  BarberController::class);
      Route::apiResource('customers', CustomerController::class);
      Route::apiResource('plans',    PlanController::class);
      Route::apiResource('closures', BusinessClosureController::class);

      // Assinaturas (admin gerencia)
      Route::post ('/subscriptions',             [SubscriptionController::class, 'store']);
      Route::patch('/subscriptions/{id}/cancel', [SubscriptionController::class, 'cancel']);

      // Relatórios (somente admin)
      Route::get('/reports/cash',    [ReportController::class, 'cash']);
      Route::get('/reports/ranking', [ReportController::class, 'ranking']);
  });

  /**
   * ========== BARBEIRO / OPERAÇÃO ==========
   * Papel do barbeiro/atendente no dia a dia.
   * Separa do admin para evitar que barbeiro acesse CRUDs globais.
   */
  Route::middleware(['role:barbeiro'])->group(function () {
      // Agenda / Atendimentos
      Route::get  ('/appointments',               [AppointmentController::class, 'index']);
      Route::post ('/appointments',               [AppointmentController::class, 'store']);
      Route::patch('/appointments/{id}',          [AppointmentController::class, 'update']);
      Route::patch('/appointments/{id}/status',   [AppointmentController::class, 'changeStatus']);

      // Fila (se usar)
      Route::get  ('/queue',            [QueueController::class, 'index']);
      Route::post ('/queue',            [QueueController::class, 'store']);
      Route::post ('/queue/{id}/call',  [QueueController::class, 'call']);
      Route::post ('/queue/{id}/assign',[QueueController::class, 'assign']);

      // Vendas (se o barbeiro registra vendas no caixa)
      Route::post('/sales',         [SaleController::class, 'store']);
      Route::get ('/sales/summary', [SaleController::class, 'summary']);
  });

  /**
   * ========== CLIENTE AUTENTICADO (futuro) ==========
   * Caso você queira permitir que o cliente logue para ver/cancelar suas marcasções.
   * Route::middleware(['role:cliente'])->group(function () { ... });
   */
});