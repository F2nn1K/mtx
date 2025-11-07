<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('cpf', 11)->unique();
            $table->string('telefone', 20);
            $table->date('data_nascimento');
            $table->string('password');
            $table->decimal('saldo', 10, 2)->default(0.00);
            $table->boolean('is_admin')->default(false);
            $table->boolean('ativo')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            
            $table->index('email');
            $table->index('cpf');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

