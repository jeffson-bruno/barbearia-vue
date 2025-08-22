<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name','description','price_month','active'];

    public function benefits(){ return $this->hasMany(PlanBenefit::class); }
}

