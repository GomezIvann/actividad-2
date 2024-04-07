<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Presta;

class PrestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear algunos registros de ejemplo para la tabla Presta
        Presta::create([
            'codigo_servicio' => 1,
            'id_empleado' => 1,
        ]);

        Presta::create([
            'codigo_servicio' => 2,
            'id_empleado' => 1,
        ]);

    }
}
