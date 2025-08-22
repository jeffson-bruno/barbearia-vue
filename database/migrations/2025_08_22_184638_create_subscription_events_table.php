<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('subscription_events', function (Blueprint $t) {
            $t->id();
            $t->foreignId('subscription_id')->constrained()->cascadeOnDelete();
            $t->enum('type', ['created','cancelled','renewed']);
            $t->timestamps(); // created_at = momento do evento
            $t->index(['subscription_id','type','created_at']);
        });
    }
    public function down(): void { Schema::dropIfExists('subscription_events'); }

};
