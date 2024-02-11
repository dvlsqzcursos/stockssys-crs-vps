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
        Schema::create('rutas_escuelas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_ruta');
            $table->integer('id_escuela');
            $table->integer('orden_llegada');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rutas_escuelas');
    }
};
