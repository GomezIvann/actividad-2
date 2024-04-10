<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiendasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear 5 tiendas con datos distintos
        DB::table('tienda')->insert([
            'horario' => '10:00 - 22:00',
            'direccion' => 'Calle Málaga, 24, Valencia',
            'telefono' => '123456789',
            'capacidad' => 50,
            'estado' => 'abierta',
            'imagen' => 'https://i.ibb.co/Rh5vt4z/tienda-1.webp',
        ]);

        DB::table('tienda')->insert([
            'horario' => '9:00 - 20:00',
            'direccion' => 'Calle Colón, 3, Valencia',
            'telefono' => '123456789',
            'capacidad' => 50,
            'estado' => 'abierta',
            'imagen' => 'https://i.ibb.co/W5TDtWg/tienda-2.jpg',
        ]);

        DB::table('tienda')->insert([
            'horario' => '8:00 - 20:00',
            'direccion' => 'Calle General Elio, 42, Valencia',
            'telefono' => '123456789',
            'capacidad' => 50,
            'estado' => 'abierta',
            'imagen' => 'https://i.ibb.co/L0Dgs19/tienda-3.jpg',
        ]);

        DB::table('tienda')->insert([
            'horario' => '9:00 - 20:00',
            'direccion' => 'Calle San Vicente, 12, Valencia',
            'telefono' => '123456789',
            'capacidad' => 50,
            'estado' => 'abierta',
            'imagen' => 'https://i.ibb.co/qC86vJG/tienda-4.webp',
        ]);
    }
}