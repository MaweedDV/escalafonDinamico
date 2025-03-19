<?php

namespace Database\Seeders;

use App\Models\User;
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
            'Id_calidad' => '2',
            'email' => 'manuel.gallardo@puertomontt.cl',
            'role' => 'admin',
            'password' => bcrypt('123456'),
            'estado' => 1
        ]);
    }
}
