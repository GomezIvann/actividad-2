<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ofrece;

class OfreceSeeder extends Seeder
{
  public function run()
  {
    Ofrece::create([
      'codigo_servicio' => 1,
      'id_cita' => 1,
    ]);
    Ofrece::create([
      'codigo_servicio' => 2,
      'id_cita' => 2,
    ]);
  }
}
