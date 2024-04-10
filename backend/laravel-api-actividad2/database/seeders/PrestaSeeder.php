<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        // Iterar sobre todos los empleados y servicios y crear la relación
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
