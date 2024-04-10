<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Empleado;

class EmpleadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear empleados de ejemplo
        DB::table('empleado')->insert([
            'nombre' => 'Empleado',
            'apellidos' => 'Ejemplo 1',
            'ciudad' => 'Ciudad Ejemplo',
            'pais' => 'País Ejemplo',
            'imagen' => 'imagenprueba',
            'red_social' => 'red social de ejemplo',
            'id_tienda' => 1, // ID de la tienda a la que pertenece este empleado
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
