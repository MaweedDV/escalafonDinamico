<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NombresCargos extends Model
{

    use HasFactory;

    protected $fillable = [
        'nombre_cargo',
        'orden',
    ];

    public function cargos_escalafon(){
        return $this->hasMany(CargosEscalafon::class, 'Id_nombresCargos');
    }

}
