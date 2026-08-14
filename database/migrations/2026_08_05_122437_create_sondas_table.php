<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sondas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->string('status', 20)->nullable()->default('Ativa');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sondas');
    }
};