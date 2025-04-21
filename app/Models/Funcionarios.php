<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionarios extends Model
{
    use HasFactory;

    protected $fillable = [
        'decreto',
        'fecha_decreto',
        'rut',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'id_Cargo',
        'calificacion',
        'lista',
        'antiguedad_cargo',
        'antiguedad_grado',
        'antiguedad_mismo_municipio',
        'antiguedad_mismo_municipio_detalle',
        'antiguedad_administracion_estado',
        'educacion_formal',
        'estado',
    ];

    public function CargosEscalafone()
    {
        return $this->belongsTo(CargosEscalafon::class, 'id_Cargo');
    }

}
