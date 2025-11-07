<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pilotos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('numero')->unique();
            $table->string('categoria', 50);
            $table->string('foto_url', 500)->nullable();
            $table->text('biografia')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
            
            $table->index('numero');
            $table->index('categoria');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pilotos');
    }
};

