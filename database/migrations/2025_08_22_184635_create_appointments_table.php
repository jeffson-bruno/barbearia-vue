<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('appointments', function (Blueprint $t) {
            $t->id();
            $t->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $t->foreignId('barber_id')->constrained()->cascadeOnDelete();
            $t->dateTime('start')->index();
            $t->dateTime('end')->index();
            $t->enum('status', [
                'solicitado','confirmado','checkin','em_andamento','concluido','no_show','cancelado'
            ])->default('solicitado')->index();
            $t->enum('source', ['portal','recepcao','fila','plano'])->default('recepcao')->index();
            $t->text('notes')->nullable();
            $t->timestamps();

            $t->index(['barber_id','start']);
        });
    }
    public function down(): void { Schema::dropIfExists('appointments'); }

};
