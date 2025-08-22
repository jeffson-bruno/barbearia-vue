<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_closures', function (Blueprint $t) {
            $t->id();
            $t->date('date')->index();
            $t->enum('type', ['holiday','early_close'])->index();
            $t->time('close_time')->nullable(); // se early_close
            $t->string('reason')->nullable();
            $t->timestamps();

            $t->unique(['date','type']);
        });
    }
    public function down(): void { Schema::dropIfExists('business_closures'); }

};
