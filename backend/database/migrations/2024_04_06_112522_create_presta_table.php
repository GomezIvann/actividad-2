<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presta', function (Blueprint $table) {
            $table->unsignedBigInteger('codigo_servicio');
            $table->unsignedBigInteger('id_empleado');
            $table->primary(['codigo_servicio', 'id_empleado']);
            $table->timestamps();
            $table->softDeletes();
            // Foreign key constraint for id_empleado
            $table->foreign('id_empleado')
                ->references('id')
                ->on('empleado')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            // Foreign key constraint for codigo_servicio
            $table->foreign('codigo_servicio')
                ->references('codigo')
                ->on('servicios')
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
        Schema::dropIfExists('presta');
    }
}