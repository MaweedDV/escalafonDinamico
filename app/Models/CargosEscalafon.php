<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargosEscalafon extends Model
{
    use HasFactory;

    protected $fillable = [
        'grado',
        'asignado',
        'Id_nombrescargos',
    ];

    public function NombresCargos(){
        return $this->belongsTo(NombresCargos::class);
    }

}
