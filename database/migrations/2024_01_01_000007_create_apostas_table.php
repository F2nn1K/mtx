<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('apostas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('corrida_id')->constrained()->onDelete('cascade');
            $table->foreignId('piloto_id')->constrained()->onDelete('cascade');
            $table->enum('tipo_aposta', ['vencedor', 'podio', 'head_to_head', 'volta_rapida']);
            $table->decimal('valor', 10, 2);
            $table->decimal('cotacao', 5, 2);
            $table->decimal('valor_possivel', 10, 2);
            $table->decimal('valor_ganho', 10, 2)->nullable();
            $table->enum('status', ['ativa', 'venceu', 'perdeu'])->default('ativa');
            $table->timestamps();
            
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apostas');
    }
};

