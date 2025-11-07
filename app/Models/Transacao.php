<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    use HasFactory;

    protected $table = 'transacoes';

    protected $fillable = [
        'user_id',
        'tipo',
        'valor',
        'status',
        'comprovante',
        'chave_pix',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
    ];

    protected $appends = [
        'tipo_label',
        'status_label',
        'status_color',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTipoLabelAttribute()
    {
        return $this->tipo === 'deposito' ? 'Depósito' : 'Saque';
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            'pendente' => 'Pendente',
            'aprovado' => 'Aprovado',
            'rejeitado' => 'Rejeitado',
        ];

        return $labels[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute()
    {
        $colors = [
            'pendente' => 'warning',
            'aprovado' => 'success',
            'rejeitado' => 'danger',
        ];

        return $colors[$this->status] ?? 'secondary';
    }
}

