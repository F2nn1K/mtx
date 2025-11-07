<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('corrida_piloto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('corrida_id')->constrained()->onDelete('cascade');
            $table->foreignId('piloto_id')->constrained()->onDelete('cascade');
            $table->decimal('cotacao', 5, 2);
            $table->timestamps();
            
            $table->unique(['corrida_id', 'piloto_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('corrida_piloto');
    }
};

