<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Presta;

class PrestaSeeder extends Seeder
{
  public function run()
  {
    Presta::create([
      'codigo_servicio' => 1,
      'id_empleado' => 1,
    ]);
    Presta::create([
      'codigo_servicio' => 2,
      'id_empleado' => 1,
    ]);
    Presta::create([
      'codigo_servicio' => 1,
      'id_empleado' => 2,
    ]);
    Presta::create([
      'codigo_servicio' => 1,
      'id_empleado' => 3,
    ]);
    Presta::create([
      'codigo_servicio' => 3,
      'id_empleado' => 3,
    ]);
    Presta::create([
      'codigo_servicio' => 4,
      'id_empleado' => 3,
    ]);
  }
}
