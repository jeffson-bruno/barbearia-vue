<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
   {
        Schema::table('users', function (Blueprint $t) {
            $t->string('phone', 20)->nullable()->after('email');
            $t->enum('role', ['admin','recepcao','barbeiro','cliente'])
            ->default('cliente')->after('phone')->index();
            $t->boolean('active')->default(true)->after('role')->index();
        });
    }
    public function down(): void
    {
        Schema::table('users', function (Blueprint $t) {
            $t->dropColumn(['phone','role','active']);
        });
    }
};
