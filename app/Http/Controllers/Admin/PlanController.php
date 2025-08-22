<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Plan, PlanBenefit};
use App\Http\Requests\PlanRequest;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
  public function index(){
    return Plan::with('benefits:id,plan_id,label')->orderBy('active','desc')->orderBy('price_month')->get();
  }

  public function store(PlanRequest $r){
    return DB::transaction(function() use($r){
      $plan = Plan::create($r->validated());
      foreach (($r->benefits ?? []) as $b) {
        PlanBenefit::create(['plan_id'=>$plan->id,'label'=>$b]);
      }
      return $plan->load('benefits');
    });
  }

  public function show(Plan $plan){ return $plan->load('benefits'); }

  public function update(PlanRequest $r, Plan $plan){
    return DB::transaction(function() use($r,$plan){
      $plan->update($r->validated());
      if ($r->has('benefits')) {
        PlanBenefit::where('plan_id',$plan->id)->delete();
        foreach ($r->benefits as $b) {
          PlanBenefit::create(['plan_id'=>$plan->id,'label'=>$b]);
        }
      }
      return $plan->load('benefits');
    });
  }

  public function destroy(Plan $plan){
    $plan->benefits()->delete();
    $plan->delete();
    return response()->noContent();
  }
}