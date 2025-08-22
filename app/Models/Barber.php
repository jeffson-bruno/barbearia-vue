<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    protected $fillable = ['user_id','bio','active'];

    public function user(){ return $this->belongsTo(User::class); }
    public function workingHours(){ return $this->hasMany(WorkingHour::class); }
}

