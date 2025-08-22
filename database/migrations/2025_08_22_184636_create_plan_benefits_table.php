<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plan_benefits', function (Blueprint $t) {
            $t->id();
            $t->foreignId('plan_id')->constrained()->cascadeOnDelete();
            $t->string('label'); // ex: "2 cortes/mês"
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('plan_benefits'); }

};
