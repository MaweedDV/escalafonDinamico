<?php

namespace Database\Seeders;

use App\Models\CalidadJuridica;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalidadJuridicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CalidadJuridica::create([
            'nombre_calidad' => 'Planta',
        ]);

        CalidadJuridica::create([
            'nombre_calidad' => 'Contrata',
        ]);

        CalidadJuridica::create([
            'nombre_calidad' => 'Código del Trabajo',
        ]);

        CalidadJuridica::create([
            'nombre_calidad' => 'Suplencia',
        ]);
    }
}
