<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function cash(Request $request)
    {
        // TODO: implementar soma do caixa por data/forma pagamento
        return response()->json(['report' => 'cash summary (stub)']);
    }

    public function ranking(Request $request)
    {
        // TODO: implementar ranking de clientes
        return response()->json(['report' => 'ranking (stub)']);
    }
}

