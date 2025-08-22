<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $t) {
            $t->id();
            $t->foreignId('appointment_id')->nullable()->constrained()->nullOnDelete();
            $t->decimal('total', 10, 2);
            $t->decimal('discount', 10, 2)->default(0);
            $t->enum('paid_with', ['dinheiro','pix','cartao'])->index();
            $t->dateTime('received_at')->index();
            $t->timestamps();

            $t->index(['received_at','paid_with']);
        });
    }
    public function down(): void { Schema::dropIfExists('sales'); }

};
