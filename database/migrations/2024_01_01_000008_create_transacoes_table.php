<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('tipo', ['deposito', 'saque']);
            $table->decimal('valor', 10, 2);
            $table->enum('status', ['pendente', 'aprovado', 'rejeitado'])->default('pendente');
            $table->text('comprovante')->nullable();
            $table->string('chave_pix')->nullable();
            $table->timestamps();
            
            $table->index('tipo');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transacoes');
    }
};

