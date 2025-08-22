<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('appointment_services', function (Blueprint $t) {
            $t->id();
            $t->foreignId('appointment_id')->constrained()->cascadeOnDelete();
            $t->foreignId('service_id')->constrained()->restrictOnDelete();
            $t->decimal('price_applied', 10, 2);
            $t->timestamps();

            $t->unique(['appointment_id','service_id']); // evita duplicar serviço
        });
    }
    public function down(): void { Schema::dropIfExists('appointment_services'); }

};
