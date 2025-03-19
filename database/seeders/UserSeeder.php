<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'rut' => '18935579-3',
            'nombre' => 'Manuel Jesus',
            'apellido_paterno' => 'Gallardo',
            'apellido_materno' => 'Pavez',
            'calidad_juridica' => '1',
            'email' => 'manuel.gallardo@puertomontt.cl',
            'position' => 'Administrador de Sistema',
            'role' => 'admin',
            'password' => bcrypt('123456789'),
            'admission_date' => '2020-01-01',
            'end_date' => '2030-01-01',
            'active' => 1
        ]);
    }
}
