<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('working_hours', function (Blueprint $t) {
            $t->id();
            $t->foreignId('barber_id')->constrained()->cascadeOnDelete();
            $t->unsignedTinyInteger('weekday'); // 0=Dom .. 6=Sáb
            $t->time('start_time');
            $t->time('end_time');
            $t->time('break_start')->nullable();
            $t->time('break_end')->nullable();
            $t->timestamps();

            $t->unique(['barber_id','weekday']);
        });
    }
    public function down(): void { Schema::dropIfExists('working_hours'); }

};
