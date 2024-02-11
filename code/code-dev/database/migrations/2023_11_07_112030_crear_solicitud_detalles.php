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
        Schema::create('solicitud_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_solicitud')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('id_escuela')->nullable();
            $table->string('mes_de_solicitud',100)->nullable();
            $table->integer('dias_de_solicitud')->nullable();
            $table->integer('ninas_pre_primaria_a_tercero_primaria')->nullable();
            $table->integer('ninos_pre_primaria_a_tercero_primaria')->nullable();
            $table->integer('total_pre_primaria_a_tercero_primaria')->nullable();
            $table->integer('ninas_cuarto_a_sexto')->nullable();
            $table->integer('ninos_cuarto_a_sexto')->nullable();
            $table->integer('total_cuarto_a_sexto')->nullable();
            $table->integer('total_de_estudiantes')->nullable();
            $table->integer('total_de_raciones_de_estudiantes')->nullable();
            $table->integer('total_docentes')->nullable();
            $table->integer('total_voluntarios')->nullable();
            $table->integer('total_de_docentes_y_voluntarios')->nullable();
            $table->integer('total_de_raciones_de_docentes_y_voluntarios')->nullable();
            $table->integer('total_de_personas')->nullable();
            $table->integer('total_de_raciones')->nullable();
            $table->integer('tipo_de_actividad_alimentos')->nullable();
            $table->integer('numero_de_entrega')->nullable();
            $table->string('tipo',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_detalles');
    }
};
