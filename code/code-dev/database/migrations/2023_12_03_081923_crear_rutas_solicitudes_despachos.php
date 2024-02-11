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
        Schema::create('rutas_solicitudes_despachos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_solicitud_despacho')->nullable();
            $table->integer('id_ruta_base')->nullable();
            $table->string('nombre')->nullable();
            $table->string('empresa_transporte')->nullable();
            $table->string('nombre_piloto')->nullable();
            $table->string('no_licencia')->nullable();
            $table->string('placa_vehiculo')->nullable();
            $table->string('tipo_vehiculo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rutas_solicitudes_despachos');
    }
};
