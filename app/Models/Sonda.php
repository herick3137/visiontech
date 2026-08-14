<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sonda extends Model
{
    use HasFactory;

    protected $table = 'sondas';
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'status',
    ];

    public function componentes()
    {
        return $this->hasMany(Componente::class, 'sonda_id');
    }
}