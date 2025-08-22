<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
  public function index(){ return Customer::orderBy('name')->paginate(20); }
  public function store(CustomerRequest $r){ return Customer::create($r->validated()); }
  public function show(Customer $customer){ return $customer; }
  public function update(CustomerRequest $r, Customer $customer){ $customer->update($r->validated()); return $customer; }
  public function destroy(Customer $customer){ $customer->delete(); return response()->noContent(); }
}
