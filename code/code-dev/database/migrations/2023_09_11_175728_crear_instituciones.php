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
        Schema::create('instituciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 400); 
            $table->string('direccion', 500);
            $table->integer('nivel');
            $table->integer('id_ubicacion');
            $table->string('encargado', 250)->nullable();
            $table->string('contacto', 40)->nullable();      
            $table->string('correo', 250)->nullable();     
            $table->string('observaciones', 500)->nullable();
            $table->integer('estado');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::unprepared('SELECT 1; SET IDENTITY_INSERT instituciones ON');
        DB::table('instituciones')->insert(array(
            'id'=>'1',
            'nombre'=>'DECAH',
            'direccion'=>'zona 5',
            'nivel'=>'0',
            'id_ubicacion'=>'3',
            'encargado'=>NULL,
            'contacto'=>NULL,
            'correo'=>NULL,
            'observaciones'=>NULL,  
            'estado'=>'0',        
        ));

        DB::table('instituciones')->insert(array(
            'id'=>'2',
            'nombre'=>'Socio Prueba',
            'direccion'=>'zona 5',
            'nivel'=>'0',
            'id_ubicacion'=>'3',
            'encargado'=>NULL,
            'contacto'=>NULL,
            'correo'=>NULL,
            'observaciones'=>NULL,  
            'estado'=>'0',        
        ));

        DB::table('instituciones')->insert(array(
            'id'=>'3',
            'nombre'=>'CRS Bodega Primaria',
            'direccion'=>'mixco guatemala',
            'nivel'=>'2',
            'id_ubicacion'=>'3',
            'encargado'=>NULL,
            'contacto'=>NULL,
            'correo'=>NULL,
            'observaciones'=>NULL,  
            'estado'=>'0',        
        ));
        DB::unprepared('SELECT 1; SET IDENTITY_INSERT instituciones OFF');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instituciones');
    }
};
