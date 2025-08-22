<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->unsignedSmallInteger('duration_min'); // 5..240
            $t->decimal('price', 10, 2);
            $t->boolean('active')->default(true)->index();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('services'); }

};
