<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corrida extends Model
{
    use HasFactory;

    protected $table = 'corridas';

    protected $fillable = [
        'nome',
        'local',
        'data_hora',
        'categoria',
        'descricao',
        'status',
        'resultado',
    ];

    protected $casts = [
        'data_hora' => 'datetime',
    ];

    public function pilotos()
    {
        return $this->belongsToMany(Piloto::class, 'corrida_piloto')
            ->withPivot('cotacao')
            ->withTimestamps();
    }

    public function apostas()
    {
        return $this->hasMany(Aposta::class);
    }

    public function getResultadoArrayAttribute()
    {
        return $this->resultado ? json_decode($this->resultado, true) : null;
    }
}

