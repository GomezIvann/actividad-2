<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitasSeeder extends Seeder
{
  public function run()
  {
    DB::table('cita')->insert([
      'fecha' => '2024-04-05',
      'hora' => '10:00:00',
      'valoracion' => 'Buena atención.',
      'id_usuario' => 1,
      'id_empleado' => 1,
      'id_tienda' => 1,
      'created_at' => now(),
      'updated_at' => now(),
    ]);
    DB::table('cita')->insert([
      'fecha' => '2024-04-06',
      'hora' => '14:30:00',
      'valoracion' => 'Excelente servicio.',
      'id_usuario' => 2,
      'id_empleado' => 1,
      'id_tienda' => 1,
      'created_at' => now(),
      'updated_at' => now(),
    ]);
  }
}