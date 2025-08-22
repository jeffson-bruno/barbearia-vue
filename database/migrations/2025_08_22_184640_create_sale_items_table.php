<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sale_items', function (Blueprint $t) {
            $t->id();
            $t->foreignId('sale_id')->constrained()->cascadeOnDelete();
            $t->foreignId('service_id')->constrained()->restrictOnDelete();
            $t->unsignedSmallInteger('qty')->default(1);
            $t->decimal('unit_price', 10, 2);
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('sale_items'); }

};
