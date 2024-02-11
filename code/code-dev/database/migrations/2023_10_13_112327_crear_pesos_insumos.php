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
        Schema::create('pesos_insumos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_insumo');
            $table->double('gramos_x_libra', 13, 5)->nullable();
            $table->double('gramos_x_kg', 13, 5)->nullable();
            $table->double('libras_x_kg', 13, 5)->nullable();
            $table->double('kg_x_unidad', 13, 5)->nullable();
            $table->double('gramos_x_unidad', 13, 5)->nullable();
            $table->double('libras_x_unidad', 13, 5)->nullable();
            $table->double('quintales_x_unidad', 13, 7)->nullable();
            $table->double('peso_bruto_quintales', 13, 5)->nullable();
            $table->double('tonelada_metrica_kg', 13, 5)->nullable();
            $table->double('unidades_x_tm', 13, 7)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesos_insumos');
    }
};
