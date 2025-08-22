<?php

namespace App\Http\Controllers\Op;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index() { return response()->json(['ok'=>true,'queue'=>[]]); }
    public function store(Request $r) { return response()->json(['ok'=>true,'queued'=>true]); }
    public function call($id) { return response()->json(['ok'=>true,'called'=>$id]); }
    public function assign($id, Request $r) { return response()->json(['ok'=>true,'assigned'=>$id]); }
}
