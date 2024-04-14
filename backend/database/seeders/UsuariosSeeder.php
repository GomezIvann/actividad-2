<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuariosSeeder extends Seeder
{
  public function run()
  {
    Usuario::create([
      'dni' => '12345678A',
      'nombre' => 'Iván',
      'apellido' => 'Gómez Pinta',
      'direccion' => 'Calle Principal 123',
      'ciudad' => 'Mieres',
      'pais' => 'España',
      'correo' => 'ivan@example.com',
      'telefono' => '123456789'
    ]);
    Usuario::create([
      'dni' => '87654321B',
      'nombre' => 'Alberto',
      'apellido' => 'Freije Carballo',
      'direccion' => 'Avenida Secundaria 456',
      'ciudad' => 'Oviedo',
      'pais' => 'España',
      'correo' => 'alberto@example.com',
      'telefono' => '987654321'
    ]);
  }
}