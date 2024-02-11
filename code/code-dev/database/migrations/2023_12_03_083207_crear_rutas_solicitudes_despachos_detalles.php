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
        Schema::create('rutas_solicitudes_despachos_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_ruta_despacho')->nullable();
            $table->integer('id_escuela')->nullable();
            $table->integer('orden_llegada')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rutas_solicitudes_despachos_detalles');
    }

};
