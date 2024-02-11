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
        Schema::create('solicitudes_bodegas_primarias_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_solicitud_bodega_primaria');
            $table->integer('id_insumo_bodega_primaria');
            $table->integer('id_insumo_bodega_socio');
            $table->double('no_unidades',13, 5);
            $table->integer('id_unidad_medida')->nullable(); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_bodegas_primarias_detalles');
    }
};
