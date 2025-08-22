<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('customers', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('phone', 20)->nullable()->index();
            $t->string('email')->nullable();
            $t->text('notes')->nullable();
            $t->boolean('active')->default(true)->index();
            $t->timestamps();
            $t->index(['name']);
        });
    }
    public function down(): void { Schema::dropIfExists('customers'); }

};
