<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalidadJuridica extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_calidad',
    ];

    public function User(){
        return $this->hasMany(User::class);
    }


}
