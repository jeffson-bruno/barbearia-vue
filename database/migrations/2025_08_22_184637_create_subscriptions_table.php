<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $t) {
            $t->id();
            $t->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $t->foreignId('plan_id')->constrained()->restrictOnDelete();
            $t->enum('status', ['active','cancelled'])->default('active')->index();
            $t->date('start_date');
            $t->date('end_date')->nullable();
            $t->enum('visit_frequency', ['weekly','biweekly','monthly'])->nullable()->index();
            $t->unsignedTinyInteger('visits_per_month')->default(0);
            $t->dateTime('next_suggested_visit')->nullable()->index();
            $t->string('cancel_reason')->nullable();
            $t->timestamps();

            $t->index(['customer_id','status']);
        });
    }
    public function down(): void { Schema::dropIfExists('subscriptions'); }

};
