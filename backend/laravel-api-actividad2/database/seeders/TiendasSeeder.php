<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiendasSeeder extends Seeder
{
  public function run()
  {
    DB::table('tienda')->insert([
      'horario' => '09:00 - 20:00',
      'direccion' => 'Calle Málaga, 24, Valencia',
      'telefono' => '123456789',
      'capacidad' => 5,
      'estado' => 'abierta',
      'imagen' => 'https://i.ibb.co/Rh5vt4z/tienda-1.webp',
    ]);
    DB::table('tienda')->insert([
      'horario' => '09:00 - 20:00',
      'direccion' => 'Calle Colón, 3, Valencia',
      'telefono' => '123456789',
      'capacidad' => 10,
      'estado' => 'abierta',
      'imagen' => 'https://i.ibb.co/W5TDtWg/tienda-2.jpg',
    ]);
    DB::table('tienda')->insert([
      'horario' => '09:00 - 20:00',
      'direccion' => 'Calle General Elio, 42, Valencia',
      'telefono' => '123456789',
      'capacidad' => 8,
      'estado' => 'abierta',
      'imagen' => 'https://i.ibb.co/L0Dgs19/tienda-3.jpg',
    ]);
    DB::table('tienda')->insert([
      'horario' => '09:00 - 20:00',
      'direccion' => 'Calle San Vicente, 12, Valencia',
      'telefono' => '123456789',
      'capacidad' => 6,
      'estado' => 'abierta',
      'imagen' => 'https://i.ibb.co/qC86vJG/tienda-4.webp',
    ]);
  }
}