<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Presta;
use App\Models\Empleado;
use App\Models\Servicio;

class PrestaSeeder extends Seeder
{
  public function run()
  {
    $empleados = Empleado::all();
    $servicios = Servicio::all();

    foreach ($empleados as $empleado) {
      foreach ($servicios as $servicio) {
        Presta::create([
          'codigo_servicio' => $servicio->codigo,
          'id_empleado' => $empleado->id,
        ]);
      }
    }
  }
}
