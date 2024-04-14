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
      'nombre' => 'Iván',
      'apellido' => 'Gómez Pinta',
      'direccion' => 'Calle Principal 123',
      'ciudad' => 'Mieres',
      'pais' => 'Asturias',
      'correo' => 'ivan@hotmail.com',
      'contraseña' => bcrypt('contraseña123'),
      'telefono' => '123456789'
    ]);
    Usuario::create([
      'dni' => '87654321B',
      'nombre' => 'Alberto',
      'apellido' => 'Freije Carballo',
      'direccion' => 'Avenida Secundaria 456',
      'ciudad' => 'Oviedo',
      'pais' => 'Asturias',
      'correo' => 'alberto@gmail.com',
      'contraseña' => bcrypt('password123'),
      'telefono' => '987654321'
    ]);
  }
}