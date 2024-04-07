<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfreceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofrece', function (Blueprint $table) {
        $table->unsignedBigInteger('codigo_servicio');
        $table->unsignedBigInteger('id_cita');
        $table->timestamps();
        // Definir las restricciones de clave primaria
        $table->primary(['codigo_servicio', 'id_cita']);

        // Restricción de clave externa para codigo_servicio
        $table->foreign('codigo_servicio')
            ->references('codigo')
            ->on('servicios')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');

        // Restricción de clave externa para id_cita
        $table->foreign('id_cita')
            ->references('id')
            ->on('cita')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ofrece');
    }
}
