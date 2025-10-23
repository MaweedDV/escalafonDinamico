<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscalafonHistorico extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_funcionario',
        'ano',
        'periodo_desde',
        'periodo_hasta',
        'posicion',
        'id_cargo',
        'calificacion',
        'lista',
    ];

}
