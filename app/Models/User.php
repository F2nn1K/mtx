<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'telefone',
        'data_nascimento',
        'password',
        'saldo',
        'is_admin',
        'ativo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'data_nascimento' => 'date',
        'saldo' => 'decimal:2',
        'is_admin' => 'boolean',
        'ativo' => 'boolean',
        'password' => 'hashed',
    ];

    public function apostas()
    {
        return $this->hasMany(Aposta::class);
    }

    public function transacoes()
    {
        return $this->hasMany(Transacao::class);
    }
}

