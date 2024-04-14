<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cita', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_empleado');
            $table->unsignedBigInteger('id_tienda');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_usuario')
                ->references('id')
                ->on('usuario')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

            $table->foreign('id_empleado')
                ->references('id')
                ->on('empleado')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

            $table->foreign('id_tienda')
                ->references('id')
                ->on('tienda')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cita');
    }
};