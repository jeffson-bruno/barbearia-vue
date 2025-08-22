<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('plans', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->text('description')->nullable();
            $t->decimal('price_month', 10, 2)->default(0);
            $t->boolean('active')->default(true)->index();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('plans'); }

};
