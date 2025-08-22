<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('push_subscriptions', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained()->cascadeOnDelete();
            $t->string('endpoint')->unique();
            $t->string('p256dh');
            $t->string('auth');
            $t->timestamps();

            $t->index(['user_id','created_at']);
        });
    }
    public function down(): void { Schema::dropIfExists('push_subscriptions'); }

};
