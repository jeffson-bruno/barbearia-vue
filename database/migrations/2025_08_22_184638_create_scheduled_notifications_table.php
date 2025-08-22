<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scheduled_notifications', function (Blueprint $t) {
            $t->id();
            $t->foreignId('appointment_id')->nullable()->constrained()->nullOnDelete();

            $t->enum('audience', ['admin','barber','client','all'])->index();
            $t->enum('kind', ['t10','t5','new_apt','plan_created','plan_cancelled','closing_notice'])->index();
            $t->enum('channel', ['webpush'])->default('webpush');

            $t->dateTime('send_at')->index();
            $t->dateTime('sent_at')->nullable()->index();
            $t->enum('status', ['pending','sent','failed','cancelled'])->default('pending')->index();

            $t->json('payload_json')->nullable(); // barber_id, customer_name, message, url etc.
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('scheduled_notifications'); }

};
