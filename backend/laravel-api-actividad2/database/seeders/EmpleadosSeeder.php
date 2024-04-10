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
    DB::table('empleado')->insert([
      'nombre' => 'Manuel',
      'apellidos' => 'Arduino Fernández',
      'ciudad' => 'Valencia',
      'pais' => 'España',
      'imagen' => 'https://i.ibb.co/zQBMJTP/empleado-1.webp',
      'red_social' => 'https://www.instagram.com/',
      'id_tienda' => 1,
      'created_at' => now(),
      'updated_at' => now(),
    ]);
    DB::table('empleado')->insert([
      'nombre' => 'Martin',
      'apellidos' => 'Cheng Ayala',
      'ciudad' => 'Valencia',
      'pais' => 'España',
      'imagen' => 'https://i.ibb.co/6Pfs0Sp/empleado-2.webp',
      'red_social' => 'https://www.instagram.com/',
      'id_tienda' => 2,
      'created_at' => now(),
      'updated_at' => now(),
    ]);
    DB::table('empleado')->insert([
      'nombre' => 'Irene',
      'apellidos' => 'Gómez Fernández',
      'ciudad' => 'Valencia',
      'pais' => 'España',
      'imagen' => 'https://i.ibb.co/W0cS2b5/empleado-3.jpg',
      'red_social' => 'https://www.instagram.com/',
      'id_tienda' => 3,
      'created_at' => now(),
      'updated_at' => now(),
    ]);
  }
}
