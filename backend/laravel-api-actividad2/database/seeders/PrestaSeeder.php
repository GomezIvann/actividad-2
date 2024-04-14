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
    // Obtener todos los empleados y servicios
    $empleados = Empleado::all();
    $servicios = Servicio::all();

    // Todos los empleados prestan todos los servicios
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
