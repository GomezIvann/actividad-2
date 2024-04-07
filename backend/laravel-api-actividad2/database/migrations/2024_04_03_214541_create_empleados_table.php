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
        Schema::create('empleado', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_usuario', 20);
            $table->string('nombre_completo', 255);
            $table->string('genero', 40)->nullable();
            $table->string('direccion', 255);
            $table->string('ciudad', 40);
            $table->string('pais', 40);
            $table->string('correo', 40);
            $table->string('contraseña', 40);
            $table->integer('telefono');
            $table->integer('salario');
            $table->date('fecha_contratacion');
            $table->string('numero_seguridad_social', 20);
            $table->unsignedBigInteger('id_tienda');
            $table->timestamps();

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
        Schema::dropIfExists('empleado');
    }
};