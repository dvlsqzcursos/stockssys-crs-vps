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
        Schema::create('raciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('tipo_alimentos')->nullable();
            $table->integer('asignado_a');
            $table->integer('tipo_bodega');
            $table->integer('id_institucion');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared('SELECT 1; SET IDENTITY_INSERT raciones ON');
        DB::table('raciones')->insert(array(
            'id'=>'1',
            'nombre'=>'Escolar',
            'tipo_alimentos'=> 'solicitud_comida_escolar',
            'asignado_a'=>'0',
            'tipo_bodega'=>'1',
            'id_institucion'=>'1'         
        ));

        DB::table('raciones')->insert(array(
            'id'=>'2',
            'nombre'=>'Lideres',
            'tipo_alimentos'=> 'lideres_de_alimentacion_escolar',
            'asignado_a'=>'1',
            'tipo_bodega'=>'1',
            'id_institucion'=>'1'              
        ));

        DB::table('raciones')->insert(array(
            'id'=>'3',
            'nombre'=>'Docentes y Voluntarios',
            'tipo_alimentos'=> 'solicitud_racion_psc',
            'asignado_a'=>'2', 
            'tipo_bodega'=>'1' ,
            'id_institucion'=>'1'          
        ));
        DB::unprepared('SELECT 1; SET IDENTITY_INSERT raciones OFF');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raciones');
    }
};
