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
            'horario' => 'Lunes a Sábado de 10:00 a 20:00',
            'direccion' => 'Calle Principal 123',
            'telefono' => '+123456789',
            'capacidad' => 10,
        ]);

        DB::table('tienda')->insert([
            'horario' => 'Lunes a Sábado de 10:00 a 20:00',
            'direccion' => 'Avenida Central 456',
            'telefono' => '+987654321',
            'capacidad' => 5,
        ]);

        DB::table('tienda')->insert([
            'horario' => 'Lunes a Viernes de 9:00 a 16:00',
            'direccion' => 'Calle Secundaria 789',
            'telefono' => '+555555555',
            'capacidad' => 4,
        ]);

        DB::table('tienda')->insert([
            'horario' => 'Lunes a Viernes de 9:00 a 16:00',
            'direccion' => 'Avenida Principal 987',
            'telefono' => '+111111111',
            'capacidad' => 12,
        ]);

        DB::table('tienda')->insert([
            'horario' => 'Lunes a Viernes de 9:00 a 16:00',
            'direccion' => 'Calle Alternativa 321',
            'telefono' => '+222222222',
            'capacidad' => 3,
        ]);
    }
}