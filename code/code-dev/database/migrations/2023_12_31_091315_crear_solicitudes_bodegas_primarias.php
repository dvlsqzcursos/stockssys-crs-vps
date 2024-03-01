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
        Schema::create('solicitudes_bodegas_primarias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->integer('id_bodega_primaria');
            $table->integer('id_socio_solicitante');            
            $table->integer('beneficiarios')->nullable();
            $table->integer('raciones_solicitadas')->nullable();
            $table->string('observaciones', 500)->nullable();
            $table->integer('estado')->nullable();
            $table->integer('id_institucion');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_bodegas_primarias');
    }
};
