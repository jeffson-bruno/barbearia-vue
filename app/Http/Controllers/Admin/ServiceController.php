<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
  public function index(){ return Service::orderBy('active','desc')->orderBy('name')->get(); }
  public function store(ServiceRequest $r){ return Service::create($r->validated()); }
  public function show(Service $service){ return $service; }
  public function update(ServiceRequest $r, Service $service){ $service->update($r->validated()); return $service; }
  public function destroy(Service $service){ $service->delete(); return response()->noContent(); }
}
