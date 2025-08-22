<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('queue_entries', function (Blueprint $t) {
        $t->id();
        $t->foreignId('customer_id')->constrained()->cascadeOnDelete();
        $t->foreignId('service_id')->nullable()->constrained()->nullOnDelete();
        $t->enum('status', ['aguardando','chamado','atendido','desistiu'])->default('aguardando')->index();
        $t->foreignId('barber_id')->nullable()->constrained()->nullOnDelete();
        $t->timestamps();

        $t->index(['status','created_at']);
    });
}
public function down(): void { Schema::dropIfExists('queue_entries'); }


};
