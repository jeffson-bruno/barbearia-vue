<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessClosure;
use App\Http\Requests\BusinessClosureRequest;

class BusinessClosureController extends Controller
{
  public function index(){ return BusinessClosure::orderBy('date','desc')->get(); }
  public function store(BusinessClosureRequest $r){ return BusinessClosure::create($r->validated()); }
  public function show(BusinessClosure $closure){ return $closure; }
  public function update(BusinessClosureRequest $r, BusinessClosure $closure){ $closure->update($r->validated()); return $closure; }
  public function destroy(BusinessClosure $closure){ $closure->delete(); return response()->noContent(); }
}