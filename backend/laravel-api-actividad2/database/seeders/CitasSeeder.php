<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear un par de citas de ejemplo
        DB::table('cita')->insert([
            'fecha' => '2024-04-05',
            'hora' => '10:00:00',
            'id_usuario' => 1, // ID del usuario asociado (DNI)
            'id_empleado' => 1, 
            'id_tienda' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cita')->insert([
            'fecha' => '2024-04-06',
            'hora' => '14:30:00',
            'id_usuario' => 2, 
            'id_empleado' => 1, 
            'id_tienda' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}