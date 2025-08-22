<?php

namespace App\Http\Controllers\Op;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function store(Request $r) {
        // cria venda + itens
        return response()->json(['ok'=>true,'sale_created'=>true]);
    }
    public function summary(Request $r) {
        // caixa do dia
        return response()->json(['ok'=>true,'summary'=>[]]);
    }
}
