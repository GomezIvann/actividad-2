<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_usuario', 20);
            $table->string('nombre_completo', 255);
            $table->string('genero', 40)->nullable();
            $table->string('direccion', 255);
            $table->string('ciudad', 40);
            $table->string('pais', 40);
            $table->string('correo', 40)->unique();
            $table->string('contraseña', 255);
            $table->bigInteger('telefono');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
