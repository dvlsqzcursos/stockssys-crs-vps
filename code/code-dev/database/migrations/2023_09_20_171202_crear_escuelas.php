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
        Schema::create('escuelas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('jornada');
            $table->string('codigo', 100);
            $table->string('nombre', 400);             
            $table->string('direccion', 500);
            $table->integer('id_ubicacion');
            $table->string('director', 400); 
            $table->string('contacto_no1', 40)->nullable();
            $table->string('contacto_no2', 40)->nullable();  
            $table->integer('no_ninos_pre')->nullable();
            $table->integer('no_ninas_pre')->nullable();
            $table->integer('no_ninos_pri')->nullable();
            $table->integer('no_ninas_pri')->nullable();
            $table->integer('no_total_beneficiarios')->nullable();
            $table->integer('no_lideres')->nullable();
            $table->integer('no_voluntarios')->nullable();
            $table->string('observaciones', 500)->nullable();
            $table->integer('id_socio')->nullable();
            $table->integer('estado');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escuelas');
    }
};
