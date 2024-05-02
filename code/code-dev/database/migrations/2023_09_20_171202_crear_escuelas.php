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

        /*DB::unprepared('SELECT 1; SET IDENTITY_INSERT escuelas ON');
        DB::table('escuelas')->insert(array(
            'id'=>'1',
            'jornada'=>0,
            'codigo'=>'08-07-9615-89',
            'nombre'=>'EORM Escuela Prueba',
            'direccion'=>'prueba de direccion',
            'id_ubicacion'=>5,
            'director'=>'Juan Ortiz',
            'contacto_no1'=>55606679,
            'contacto_no2'=>55606678,
            'no_ninos_pre'=>25,
            'no_ninas_pre'=>25,
            'no_ninos_pri'=>25,
            'no_ninas_pri'=>25,
            'no_lideres'=>2,
            'no_voluntarios'=>10,
            'no_total_beneficiarios'=>100,
            'observaciones'=>null,        
            'estado'=>0,
            'id_socio'=>2    
        ));

        DB::table('escuelas')->insert(array(
            'id'=>'2',
            'jornada'=>0,
            'codigo'=>'08-07-9615-90',
            'nombre'=>'EORM Escuela Prueba',
            'direccion'=>'prueba de direccion',
            'id_ubicacion'=>5,
            'director'=>'Juan Ortiz',
            'contacto_no1'=>55606679,
            'contacto_no2'=>55606678,
            'no_ninos_pre'=>25,
            'no_ninas_pre'=>25,
            'no_ninos_pri'=>25,
            'no_ninas_pri'=>25,
            'no_lideres'=>2,
            'no_voluntarios'=>10,
            'no_total_beneficiarios'=>100,
            'observaciones'=>null,        
            'estado'=>0,
            'id_socio'=>2     
        ));
        DB::unprepared('SELECT 1; SET IDENTITY_INSERT escuelas OFF');*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escuelas');
    }
};
