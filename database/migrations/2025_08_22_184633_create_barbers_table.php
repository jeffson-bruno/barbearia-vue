<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barbers', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained()->cascadeOnDelete();
            $t->text('bio')->nullable();
            $t->boolean('active')->default(true)->index();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('barbers'); }

};
