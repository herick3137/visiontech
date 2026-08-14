<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('componentes', function (Blueprint $table) {
            $table->id();
            $table->string('numero_serie', 50)->unique();
            $table->string('nome', 100);
            $table->enum('status', ['operacao', 'estoque', 'manutencao'])->default('estoque');
            $table->string('localizacao_atual', 50);
            $table->foreignId('sonda_id')->nullable()->constrained('sondas')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('componentes');
    }
};