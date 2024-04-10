<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiciosSeeder extends Seeder
{
    public function run()
    {
        // Crear los servicios con los datos proporcionados
        DB::table('servicios')->insert([
            'nombre' => 'Corte de cabello',
            'descripcion' => 'Nos ajustamos a tus necesidades y estilo personal para ofrecer un servicio exclusivo acorde a lo que buscas. Te asesoramos  teniendo en cuenta tus gustos y las tendencias actuales.',
            'precio' => 12,
        ]);

        DB::table('servicios')->insert([
            'nombre' => 'Afeitado',
            'descripcion' => 'Sácale el mayor partido a tu barba. Con nuestros diseños pretendemos arreglar tu barba delimitando los contornos a través de un afeitado tradicional, además de recomendarte su correcto mantenimiento en casa.',
            'precio' => 6,
        ]);

        DB::table('servicios')->insert([
            'nombre' => 'Técnicas',
            'descripcion' => 'Aplicamos nuestras técnicas de corte para todas las edades, gustos y estilos. Realizamos nuestro afeitado tradicional a la navaja con toalla caliente y fría, trabajos de mechas y color, matizado de canas según el color de tu barba, y muchos más.',
            'precio' => 15,
        ]);

        DB::table('servicios')->insert([
            'nombre' => 'Tratamientos',
            'descripcion' => 'Los mejores cuidados para un increíble acabado. Una amplia gama de tratamientos para el cabello, barba y piel.',
            'precio' => 10,
        ]);
    }
}