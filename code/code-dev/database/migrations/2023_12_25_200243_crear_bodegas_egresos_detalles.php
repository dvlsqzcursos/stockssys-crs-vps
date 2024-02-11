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
        Schema::create('bodegas_egresos_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_egreso');
            $table->integer('id_insumo');
            $table->integer('pl')->nullable();
            $table->double('no_unidades',13, 5); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bodegas_egresos_detalles');
    }
};
