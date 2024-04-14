<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    $this->call(TiendasSeeder::class);
    $this->call(UsuariosSeeder::class);
    $this->call(ServiciosSeeder::class);
    $this->call(EmpleadosSeeder::class);
    $this->call(CitasSeeder::class);
    $this->call(PrestaSeeder::class);
    $this->call(OfreceSeeder::class);
  }
}
