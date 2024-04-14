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
            $table->string('nombre', 255);
            $table->string('apellidos', 255);
            $table->string('ciudad', 40);
            $table->string('pais', 40);
            $table->string('imagen');
            $table->string('red_social');
            $table->unsignedBigInteger('id_tienda');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_tienda')
                ->references('id')
                ->on('tienda')
                ->onDelete('CASCADE')
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