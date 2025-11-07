<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('corridas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('local');
            $table->dateTime('data_hora');
            $table->string('categoria', 50);
            $table->text('descricao')->nullable();
            $table->enum('status', ['aberta', 'ao_vivo', 'finalizada', 'cancelada'])->default('aberta');
            $table->text('resultado')->nullable();
            $table->timestamps();
            
            $table->index('status');
            $table->index('data_hora');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('corridas');
    }
};

