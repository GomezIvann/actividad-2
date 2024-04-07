<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiciosSeeder extends Seeder
{
    public function run()
    {
        // Crear 5 servicios con datos distintos
        DB::table('servicios')->insert([
            'descripcion' => 'Corte de pelo',
            'puntos' => 10,
            'nombre' => 'Corte de pelo estándar',
            'precio' => 15.00,
        ]);

        DB::table('servicios')->insert([
            'descripcion' => 'Tinte de cabello',
            'puntos' => 15,
            'nombre' => 'Tinte de cabello completo',
            'precio' => 30.00,
        ]);

        DB::table('servicios')->insert([
            'descripcion' => 'Manicura',
            'puntos' => 5,
            'nombre' => 'Manicura básica',
            'precio' => 20.00,
        ]);

        DB::table('servicios')->insert([
            'descripcion' => 'Depilación',
            'puntos' => 8,
            'nombre' => 'Depilación de piernas',
            'precio' => 25.00,
        ]);

        DB::table('servicios')->insert([
            'descripcion' => 'Maquillaje',
            'puntos' => 12,
            'nombre' => 'Maquillaje profesional',
            'precio' => 40.00,
        ]);
    }
}
