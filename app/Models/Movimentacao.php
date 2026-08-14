<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    use HasFactory;

    protected $table = 'movimentacoes';
    public $timestamps = false;

    protected $fillable = [
        'componente_id',
        'origem',
        'destino',
        'usuario_id',
        'usuario',
        'data_hora',
    ];

    protected $casts = [
        'data_hora' => 'datetime',
    ];

    public function componente()
    {
        return $this->belongsTo(Componente::class, 'componente_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}