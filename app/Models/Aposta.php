<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aposta extends Model
{
    use HasFactory;

    protected $table = 'apostas';

    protected $fillable = [
        'user_id',
        'corrida_id',
        'piloto_id',
        'tipo_aposta',
        'valor',
        'cotacao',
        'valor_possivel',
        'valor_ganho',
        'status',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'cotacao' => 'decimal:2',
        'valor_possivel' => 'decimal:2',
        'valor_ganho' => 'decimal:2',
    ];

    protected $appends = [
        'tipo_aposta_label',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function corrida()
    {
        return $this->belongsTo(Corrida::class);
    }

    public function piloto()
    {
        return $this->belongsTo(Piloto::class);
    }

    public function getTipoApostaLabelAttribute()
    {
        $labels = [
            'vencedor' => 'Vencedor da Corrida',
            'podio' => 'Pódio (Top 3)',
            'head_to_head' => 'Head-to-Head',
            'volta_rapida' => 'Volta Mais Rápida',
        ];

        return $labels[$this->tipo_aposta] ?? $this->tipo_aposta;
    }
}

