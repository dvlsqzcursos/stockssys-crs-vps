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
        Schema::create('bodegas_ingresos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->integer('id_bodega_despacho')->nullable();
            $table->string('procedente')->nullable();
            $table->integer('tipo_documento')->nullable();
            $table->string('no_documento',250)->nullable();
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
        Schema::dropIfExists('bodegas_ingresos');
    }
};
