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
        Schema::create('bodegas_egresos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->integer('tipo_documento')->nullable();
            $table->integer('no_documento')->nullable();
            $table->integer('tipo_bodega')->nullable();   
            $table->integer('id_socio_despacho')->nullable();     
            $table->integer('id_solicitud_despacho')->nullable(); 
            $table->integer('id_escuela_despacho')->nullable(); 
            $table->integer('tipo_racion')->nullable();   
            $table->integer('tipo_kit')->nullable();  
            $table->string('destino')->nullable();         
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
        Schema::dropIfExists('bodegas_egresos');
    }
};
