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
            'nombre_usuario' => 'empleado1',
            'nombre_completo' => 'Empleado Ejemplo 1',
            'genero' => 'Masculino',
            'direccion' => 'Calle Principal 123',
            'ciudad' => 'Ciudad Ejemplo',
            'pais' => 'País Ejemplo',
            'correo' => 'empleado1@example.com',
            'contraseña' => '123456', // Recuerda que esto debería ser encriptado en una aplicación real
            'telefono' => '123456789',
            'salario' => 2000,
            'fecha_contratacion' => now(),
            'numero_seguridad_social' => '1234567890',
            'id_tienda' => 1, // ID de la tienda a la que pertenece este empleado
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
