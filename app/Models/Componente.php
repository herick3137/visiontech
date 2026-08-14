<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    use HasFactory;

    protected $table = 'componentes';
    public $timestamps = false;

    protected $fillable = [
        'numero_serie',
        'nome',
        'status',
        'localizacao_atual',
        'sonda_id',
    ];

    public function sonda()
    {
        return $this->belongsTo(Sonda::class, 'sonda_id');
    }

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class, 'componente_id');
    }
}