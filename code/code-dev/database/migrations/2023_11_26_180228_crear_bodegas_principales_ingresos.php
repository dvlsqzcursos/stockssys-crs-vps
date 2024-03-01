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
        Schema::create('bodegas_principales_ingresos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('procedente')->nullable();
            $table->integer('no_pl')->nullable();
            $table->integer('no_bl')->nullable();
            $table->date('fecha_ingreso')->nullable();           
            $table->date('fecha_bubd')->nullable();
            $table->integer('id_insumo');
            $table->double('no_unidades',13, 5);
            $table->double('peso_unidad',13, 5);
            $table->double('peso_total',13, 5);
            $table->integer('tipo_bodega')->nullable();
            $table->integer('id_institucion')->nullable();            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bodegas_principales_ingresos');
    }
};
