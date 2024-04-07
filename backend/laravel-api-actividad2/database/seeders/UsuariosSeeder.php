<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear usuarios de ejemplo
        Usuario::create([
            'nombre_usuario' => 'usuario1',
            'nombre_completo' => 'Usuario Ejemplo 1',
            'genero' => 'Masculino',
            'direccion' => 'Calle Principal 123',
            'ciudad' => 'Ciudad Ejemplo',
            'pais' => 'País Ejemplo',
            'correo' => 'usuario1@example.com',
            'contraseña' => bcrypt('contraseña123'),
            'telefono' => 123456789
        ]);

        Usuario::create([
            'nombre_usuario' => 'usuario2',
            'nombre_completo' => 'Usuario Ejemplo 2',
            'genero' => 'Femenino',
            'direccion' => 'Avenida Secundaria 456',
            'ciudad' => 'Otra Ciudad',
            'pais' => 'Otro País',
            'correo' => 'usuario2@example.com',
            'contraseña' => bcrypt('password123'),
            'telefono' => 987654321
        ]);

        
    }
}
