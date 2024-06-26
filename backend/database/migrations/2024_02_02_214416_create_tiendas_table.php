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
        Schema::create('tienda', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('horario');
            $table->string('direccion');
            $table->string('telefono');
            $table->integer('capacidad');
            $table->string('estado');
            $table->string('imagen');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tienda');
    }
};
