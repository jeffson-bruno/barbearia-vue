<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanBenefit extends Model
{
    protected $fillable = ['plan_id','label'];

    public function plan(){ return $this->belongsTo(Plan::class); }
}
