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
        Schema::create('bodegas_socios_ingresos_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_ingreso');
            $table->integer('id_insumo');
            $table->integer('pl');
            $table->double('no_unidades',13, 5);
            $table->double('unidad_medida',13, 5);
            $table->double('peso_total',13, 5);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bodegas_socios_ingresos_detalles');
    }
};
