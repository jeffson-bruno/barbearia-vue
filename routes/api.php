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

// Rotas protegidas (SPA com Sanctum)
Route::middleware('auth:sanctum')->group(function () {

  // PWA / Push
  Route::post('/push/subscribe', [PushController::class, 'subscribe']);
  Route::delete('/push/unsubscribe', [PushController::class, 'unsubscribe']);

  // Admin CRUDs
  Route::apiResource('services', ServiceController::class);
  Route::apiResource('barbers', BarberController::class);
  Route::apiResource('customers', CustomerController::class);
  Route::apiResource('plans', PlanController::class);
  Route::apiResource('closures', BusinessClosureController::class);

  // Assinaturas
  Route::post('/subscriptions', [SubscriptionController::class, 'store']);
  Route::patch('/subscriptions/{id}/cancel', [SubscriptionController::class, 'cancel']);

  // Operação
  Route::get('/appointments', [AppointmentController::class, 'index']);
  Route::post('/appointments', [AppointmentController::class, 'store']);
  Route::patch('/appointments/{id}', [AppointmentController::class, 'update']);
  Route::patch('/appointments/{id}/status', [AppointmentController::class, 'changeStatus']);

  Route::get('/queue', [QueueController::class, 'index']);
  Route::post('/queue', [QueueController::class, 'store']);
  Route::post('/queue/{id}/call', [QueueController::class, 'call']);
  Route::post('/queue/{id}/assign', [QueueController::class, 'assign']);

  Route::post('/sales', [SaleController::class, 'store']);
  Route::get('/sales/summary', [SaleController::class, 'summary']);

  // Relatórios
  Route::get('/reports/cash', [ReportController::class, 'cash']);
  Route::get('/reports/ranking', [ReportController::class, 'ranking']);
});
