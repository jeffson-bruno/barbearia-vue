<?php

namespace App\Http\Controllers\Op;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $r) {
        // filtros: barber_id, date, status...
        return response()->json(['ok'=>true,'appointments'=>[]]);
    }
    public function store(Request $r) {
        // criar appointment + notificações
        return response()->json(['ok'=>true,'created'=>true]);
    }
    public function update(Request $r, $id) {
        // reagendar e recriar notificações
        return response()->json(['ok'=>true,'updated'=>$id]);
    }
    public function changeStatus(Request $r, $id) {
        // checkin/em_andamento/concluido/no_show/cancelado
        return response()->json(['ok'=>true,'status_changed_of'=>$id]);
    }
}

