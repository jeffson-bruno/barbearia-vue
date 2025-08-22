<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barber;
use App\Http\Requests\BarberRequest;

class BarberController extends Controller
{
  public function index(){ return Barber::with('user:id,name,email')->orderBy('id','desc')->get(); }
  public function store(BarberRequest $r){ return Barber::create($r->validated()); }
  public function show(Barber $barber){ return $barber->load('user:id,name,email'); }
  public function update(BarberRequest $r, Barber $barber){ $barber->update($r->validated()); return $barber; }
  public function destroy(Barber $barber){ $barber->delete(); return response()->noContent(); }
}
