<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        // TODO: criar assinatura e event 'created'
        return response()->json(['ok' => true, 'action' => 'subscription created (stub)']);
    }

    public function cancel($id, Request $request)
    {
        // TODO: cancelar assinatura e event 'cancelled'
        return response()->json(['ok' => true, 'action' => "subscription {$id} cancelled (stub)"]);
    }
}

