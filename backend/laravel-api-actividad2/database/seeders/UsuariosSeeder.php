<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([
            'dni' => '12345678A',
            'nombre' => 'Usuario',
            'apellido' => 'Ejemplo 1',
            'direccion' => 'Calle Principal 123',
            'ciudad' => 'Ciudad Ejemplo',
            'pais' => 'País Ejemplo',
            'correo' => 'usuario1@example.com',
            'contraseña' => bcrypt('contraseña123'),
            'telefono' => '123456789'
        ]);
        Usuario::create([
            'dni' => '87654321B',
            'nombre' => 'Usuario',
            'apellido' => 'Ejemplo 2',
            'direccion' => 'Avenida Secundaria 456',
            'ciudad' => 'Otra Ciudad',
            'pais' => 'Otro País',
            'correo' => 'usuario2@example.com',
            'contraseña' => bcrypt('password123'),
            'telefono' => '987654321'
        ]);
    }
}