<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piloto extends Model
{
    use HasFactory;

    protected $table = 'pilotos';

    protected $fillable = [
        'nome',
        'numero',
        'categoria',
        'foto_url',
        'biografia',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
        'numero' => 'integer',
    ];

    public function corridas()
    {
        return $this->belongsToMany(Corrida::class, 'corrida_piloto')
            ->withPivot('cotacao')
            ->withTimestamps();
    }

    public function apostas()
    {
        return $this->hasMany(Aposta::class);
    }
}

